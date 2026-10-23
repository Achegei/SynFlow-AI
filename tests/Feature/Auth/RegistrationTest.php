<?php

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Institution;
use App\Models\SalesExecutive;
use App\Models\User;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register through an institution', function () {
    $course = Course::create([
        'title' => 'Legacy Registration Test Course',
        'price' => 5500,
    ]);

    config()->set('enrollment.course_id', $course->id);

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
        'name' => 'Test Institution',
        'slug' => 'test-institution',
        'referral_code' => 'TEST-INSTITUTION',
        'sales_executive_id' => $executive->id,
        'wallet_balance' => 0,
        'status' => 'active',
    ]);

    $response = $this
        ->withSession([
            'registration_context' => 'institution',
            'selected_institution_id' => $institution->id,
        ])
        ->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

    $user = User::where('email', 'test@example.com')->firstOrFail();

    $enrollment = CourseEnrollment::where('user_id', $user->id)
        ->where('course_id', $course->id)
        ->firstOrFail();

    $this->assertAuthenticatedAs($user);

    $response->assertRedirect(
        route('purchase.show', $course->id)
    );

    $this->assertSame('student', $user->role);
    $this->assertSame($institution->id, $user->institution_id);
    $this->assertFalse((bool) $user->must_change_password);
    $this->assertTrue((bool) $user->initial_password_reset_required);

    $this->assertSame('institution', $enrollment->registration_context);
    $this->assertSame($institution->id, $enrollment->institution_id);
    $this->assertSame($executive->id, $enrollment->sales_executive_id);
    $this->assertSame('pending', $enrollment->status);
});
