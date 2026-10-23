<?php

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Institution;
use App\Models\SalesExecutive;
use App\Models\User;
use App\Services\CourseEnrollmentService;
use Illuminate\Support\Facades\Event;

beforeEach(function () {
    Event::fake();

    $course = Course::create([
        'title' => 'Registration Integration Test Course',
        'price' => 5500,
    ]);

    config()->set('enrollment.course_id', $course->id);
});

function enrollmentRegistrationPayload(string $email): array
{
    return [
        'name' => 'Enrollment Test Student',
        'email' => $email,
        'password' => 'password',
        'password_confirmation' => 'password',
    ];
}

test('institutional registration creates attributed pending enrollment', function () {
    $executiveUser = User::factory()->create([
        'role' => 'sales_executive',
    ]);

    $executive = SalesExecutive::create([
        'user_id' => $executiveUser->id,
        'wallet_balance' => 0,
        'commission_percentage' => 10,
        'status' => 'active',
    ]);

    $institution = Institution::create([
        'name' => 'Registration Test College',
        'slug' => 'registration-test-college',
        'referral_code' => 'REG-COLLEGE',
        'sales_executive_id' => $executive->id,
        'wallet_balance' => 0,
        'status' => 'active',
    ]);

    $response = $this
        ->withSession([
            'registration_context' => 'institution',
            'selected_institution_id' => $institution->id,
        ])
        ->post('/register', enrollmentRegistrationPayload(
            'institutional-registration@example.com'
        ));

    $student = User::where(
        'email',
        'institutional-registration@example.com'
    )->firstOrFail();

    $enrollment = CourseEnrollment::where(
        'user_id',
        $student->id
    )->firstOrFail();

    $this->assertAuthenticatedAs($student);

    $response->assertRedirect(
        route('purchase.show', $enrollment->course_id)
    );

    expect($student->institution_id)->toBe($institution->id)
        ->and($enrollment->registration_context)->toBe('institution')
        ->and($enrollment->institution_id)->toBe($institution->id)
        ->and($enrollment->sales_executive_id)->toBe($executive->id)
        ->and($enrollment->status)->toBe('pending')
        ->and($enrollment->paid_at)->toBeNull();
});

test('independent registration creates unattributed pending enrollment', function () {
    $response = $this
        ->withSession([
            'registration_context' => 'other',
        ])
        ->post('/register', enrollmentRegistrationPayload(
            'independent-registration@example.com'
        ));

    $student = User::where(
        'email',
        'independent-registration@example.com'
    )->firstOrFail();

    $enrollment = CourseEnrollment::where(
        'user_id',
        $student->id
    )->firstOrFail();

    $this->assertAuthenticatedAs($student);

    $response->assertRedirect(
        route('purchase.show', $enrollment->course_id)
    );

    expect($student->institution_id)->toBeNull()
        ->and($enrollment->registration_context)->toBe('other')
        ->and($enrollment->institution_id)->toBeNull()
        ->and($enrollment->sales_executive_id)->toBeNull()
        ->and($enrollment->status)->toBe('pending');
});

test('registration without pathway does not create a student', function () {
    $response = $this->post(
        '/register',
        enrollmentRegistrationPayload(
            'missing-pathway@example.com'
        )
    );

    $response->assertRedirect(route('choose.university'));

    expect(User::where(
        'email',
        'missing-pathway@example.com'
    )->exists())->toBeFalse();
});

test('registration rolls back user when enrollment creation fails', function () {
    $this->mock(CourseEnrollmentService::class, function ($mock) {
        $mock->shouldReceive('create')
            ->once()
            ->andThrow(new RuntimeException(
                'Simulated enrollment failure'
            ));
    });

    try {
        $this->withSession([
            'registration_context' => 'other',
        ])->post('/register', enrollmentRegistrationPayload(
            'rollback-registration@example.com'
        ));
    } catch (RuntimeException $exception) {
        expect($exception->getMessage())->toBe(
            'Simulated enrollment failure'
        );
    }

    expect(User::where(
        'email',
        'rollback-registration@example.com'
    )->exists())->toBeFalse();
});
