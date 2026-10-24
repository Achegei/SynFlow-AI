<?php

use App\Models\CommissionTransaction;
use App\Models\CourseEnrollment;
use App\Models\Institution;
use App\Models\SalesExecutive;
use App\Models\User;
use Illuminate\Support\Facades\DB;

function createSalesDashboardFixture(): array
{
    $user = User::factory()->create([
        'role' => 'sales_executive',
        'must_change_password' => false,
    ]);

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 0,
        'commission_percentage' => 10,
        'status' => 'active',
    ]);

    $institution = Institution::create([
        'name' => 'Sales Metrics Test College',
        'slug' => 'sales-metrics-test-college',
        'referral_code' => 'SALES-METRICS-001',
        'sales_executive_id' => $executive->id,
        'status' => 'active',
        'wallet_balance' => 0,
    ]);

    return [$user, $executive, $institution];
}

test('sales dashboard shows fixed commission instead of legacy percentage', function () {
    [$user] = createSalesDashboardFixture();

    $this->actingAs($user)
        ->get(route('sales.dashboard'))
        ->assertOk()
        ->assertSee('KES 1,000 per qualifying paid enrollment')
        ->assertDontSee('10.00%');
});

test('sales dashboard counts historical students registered under assigned institutions', function () {
    [$user, , $institution] = createSalesDashboardFixture();

    User::factory()->create([
        'role' => 'student',
        'institution_id' => $institution->id,
        'created_at' => now()->subDays(20),
    ]);

    $response = $this->actingAs($user)
        ->get(route('sales.dashboard'))
        ->assertOk();

    $response->assertViewHas('totalStudents', 1);
});

test('sales dashboard reports daily student registrations', function () {
    [$user, , $institution] = createSalesDashboardFixture();

    User::factory()->create([
        'role' => 'student',
        'institution_id' => $institution->id,
        'created_at' => now(),
    ]);

    User::factory()->create([
        'role' => 'student',
        'institution_id' => $institution->id,
        'created_at' => now()->subDay(),
    ]);

    $response = $this->actingAs($user)
        ->get(route('sales.dashboard'))
        ->assertOk();

    $response->assertViewHas('newToday', 1);
    $response->assertViewHas('newYesterday', 1);
    $response->assertViewHas('newLast7Days', 2);
});

test('sales dashboard has no earned commission for unpaid registrations', function () {
    [$user, , $institution] = createSalesDashboardFixture();

    User::factory()->create([
        'role' => 'student',
        'institution_id' => $institution->id,
    ]);

    $response = $this->actingAs($user)
        ->get(route('sales.dashboard'))
        ->assertOk();

    $response->assertViewHas('paidEnrollments', 0);
    $response->assertViewHas('totalCommissionEarned', function ($amount) {
        return (float) $amount === 0.0;
    });
});

test('sales dashboard does not count students belonging only to other institutions', function () {
    [$user] = createSalesDashboardFixture();

    $otherInstitution = Institution::create([
        'name' => 'Unassigned College',
        'slug' => 'unassigned-college',
        'referral_code' => 'UNASSIGNED-001',
        'status' => 'active',
        'wallet_balance' => 0,
    ]);

    User::factory()->create([
        'role' => 'student',
        'institution_id' => $otherInstitution->id,
    ]);

    $response = $this->actingAs($user)
        ->get(route('sales.dashboard'))
        ->assertOk();

    $response->assertViewHas('totalStudents', 0);
});


test('sales dashboard deduplicates legacy and course enrollment students', function () {
    [$user, $executive, $institution] = createSalesDashboardFixture();

    $student = User::factory()->create([
        'role' => 'student',
        'institution_id' => $institution->id,
    ]);

    $course = \App\Models\Course::create([
        'title' => 'Sales Dashboard Test Course',
        'description' => 'Course used to verify sales dashboard metrics.',
        'price' => 5500,
    ]);

    CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'institution',
        'institution_id' => $institution->id,
        'sales_executive_id' => $executive->id,
        'status' => 'pending',
    ]);

    $this->actingAs($user)
        ->get(route('sales.dashboard'))
        ->assertOk()
        ->assertViewHas('totalStudents', 1);
});

test('sales dashboard counts paid enrollments only for its executive', function () {
    [$user, $executive, $institution] = createSalesDashboardFixture();

    $student = User::factory()->create([
        'role' => 'student',
        'institution_id' => $institution->id,
    ]);

    $course = \App\Models\Course::create([
        'title' => 'Sales Dashboard Test Course',
        'description' => 'Course used to verify sales dashboard metrics.',
        'price' => 5500,
    ]);

    CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'institution',
        'institution_id' => $institution->id,
        'sales_executive_id' => $executive->id,
        'status' => 'paid',
        'paid_at' => now(),
    ]);

    $this->actingAs($user)
        ->get(route('sales.dashboard'))
        ->assertOk()
        ->assertViewHas('paidEnrollments', 1);
});

test('sales dashboard counts newly enrolled students without legacy institution association', function () {
    [$user, $executive, $institution] = createSalesDashboardFixture();

    $student = User::factory()->create([
        'role' => 'student',
        'institution_id' => null,
    ]);

    $course = \App\Models\Course::create([
        'title' => 'Sales Dashboard Test Course',
        'description' => 'Course used to verify sales dashboard metrics.',
        'price' => 5500,
    ]);

    CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'registration_context' => 'institution',
        'institution_id' => $institution->id,
        'sales_executive_id' => $executive->id,
        'status' => 'pending',
    ]);

    $this->actingAs($user)
        ->get(route('sales.dashboard'))
        ->assertOk()
        ->assertViewHas('totalStudents', 1);
});


test('sales dashboard reports actual commission ledger earnings', function () {
    [$user, $executive, $institution] = createSalesDashboardFixture();

    $student = User::factory()->create([
        'role' => 'student',
        'institution_id' => $institution->id,
    ]);

    $course = \App\Models\Course::create([
        'title' => 'Commission Ledger Test Course',
        'description' => 'Course for commission dashboard testing.',
        'price' => 5500,
    ]);

    $payment = \App\Models\Payment::create([
        'user_id' => $student->id,
        'course_id' => $course->id,
        'payment_type' => 'course',
        'provider' => 'test',
        'payment_id' => 'SALES-LEDGER-TEST-001',
        'status' => 'paid',
        'amount' => 5500,
        'currency' => 'KES',
        'paid_at' => now(),
    ]);

    CommissionTransaction::create([
        'payment_id' => $payment->id,
        'student_id' => $student->id,
        'institution_id' => $institution->id,
        'sales_executive_id' => $executive->id,
        'course_id' => $course->id,
        'total_amount' => 5500,
        'institution_amount' => 2200,
        'sales_amount' => 1000,
        'company_amount' => 2300,
    ]);

    $this->actingAs($user)
        ->get(route('sales.dashboard'))
        ->assertOk()
        ->assertViewHas('totalCommissionEarned', function ($amount) {
            return (float) $amount === 1000.0;
        });
});
