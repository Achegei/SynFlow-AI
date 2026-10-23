<?php

use App\Filament\Resources\PaymentReconciliationResource;
use App\Filament\Resources\PaymentReconciliationResource\Pages\ListPaymentReconciliations;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Payment;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    \Filament\Facades\Filament::setCurrentPanel(
        \Filament\Facades\Filament::getPanel('admin')
    );
});

function reconciliationTestPayment(
    User $student,
    Course $course,
    ?CourseEnrollment $enrollment,
    string $status,
    ?string $invoice
): Payment {
    return Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'course_enrollment_id' => $enrollment?->id,
        'provider' => 'intasend',
        'payment_type' => 'course',
        'api_ref' => 'test-reconciliation-' . \Illuminate\Support\Str::uuid(),
        'payment_id' => $invoice,
        'status' => $status,
        'amount' => 5500,
        'currency' => 'KES',
    ]);
}

test('guests cannot access payment reconciliation', function () {
    $this->get(
        PaymentReconciliationResource::getUrl('index')
    )->assertStatus(403);
});

test('ordinary students cannot access payment reconciliation', function () {
    $student = User::factory()->create([
        'is_admin' => false,
        'role' => 'student',
    ]);

    $this->actingAs($student)
        ->get(PaymentReconciliationResource::getUrl('index'))
        ->assertForbidden();
});

test('academy administrators can access payment reconciliation', function () {
    $admin = User::factory()->create([
        'is_admin' => true,
        'role' => 'admin',
    ]);

    $this->actingAs($admin)
        ->get(PaymentReconciliationResource::getUrl('index'))
        ->assertOk();
});

test('reconciliation query contains only pending enrollment payments', function () {
    $student = User::factory()->create();

    $course = Course::create([
        'title' => 'Reconciliation Test Course',
        'price' => 5500,
    ]);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'other',
        'status' => 'pending',
    ]);

    $invoiceMissing = reconciliationTestPayment(
        $student, $course, $enrollment, 'pending', null
    );

    $invoicePresent = reconciliationTestPayment(
        $student, $course, $enrollment, 'pending', 'TEST-INV-RECON-1'
    );

    $paid = reconciliationTestPayment(
        $student, $course, $enrollment, 'paid', 'TEST-INV-RECON-2'
    );

    $legacy = reconciliationTestPayment(
        $student, $course, null, 'pending', 'TEST-INV-RECON-3'
    );

    $ids = PaymentReconciliationResource::getEloquentQuery()
        ->pluck('id')
        ->all();

    expect($ids)
        ->toContain($invoiceMissing->id, $invoicePresent->id)
        ->not->toContain($paid->id, $legacy->id);
});

test('reconciliation list displays invoice-less attempts to administrators', function () {
    $admin = User::factory()->create([
        'is_admin' => true,
        'role' => 'admin',
    ]);

    $student = User::factory()->create([
        'name' => 'Reconciliation Test Student',
    ]);

    $course = Course::create([
        'title' => 'Reconciliation Visibility Course',
        'price' => 5500,
    ]);

    $enrollment = CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'other',
        'status' => 'pending',
    ]);

    $payment = reconciliationTestPayment(
        $student, $course, $enrollment, 'pending', null
    );

    $this->actingAs($admin);

    Livewire::test(ListPaymentReconciliations::class)
        ->assertSuccessful()
        ->assertCanSeeTableRecords([$payment])
        ->assertSee('Invoice missing');
});

test('payment reconciliation resource is read only', function () {
    expect(PaymentReconciliationResource::canCreate())->toBeFalse()
        ->and(PaymentReconciliationResource::canDeleteAny())->toBeFalse();

    $payment = new Payment();

    expect(PaymentReconciliationResource::canEdit($payment))->toBeFalse()
        ->and(PaymentReconciliationResource::canDelete($payment))->toBeFalse();

    expect(array_keys(PaymentReconciliationResource::getPages()))
        ->toBe(['index']);
});
