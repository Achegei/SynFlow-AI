<?php

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\User;

beforeEach(function () {
    $course = Course::create([
        'title' => 'Checkout Authorization Test Course',
        'price' => 5500,
    ]);

    config()->set('enrollment.course_id', $course->id);
});

function checkoutGuardCourse(): Course
{
    return Course::findOrFail(
        (int) config('enrollment.course_id')
    );
}

function checkoutGuardEnrollment(
    User $student,
    string $status = 'pending'
): CourseEnrollment {
    return CourseEnrollment::create([
        'user_id' => $student->id,
        'course_id' => checkoutGuardCourse()->id,
        'registration_context' => 'other',
        'institution_id' => null,
        'sales_executive_id' => null,
        'status' => $status,
        'paid_at' => $status === 'paid' ? now() : null,
    ]);
}

test('pending enrollment student can view course checkout', function () {
    $student = User::factory()->create(['role' => 'student']);
    $course = checkoutGuardCourse();

    checkoutGuardEnrollment($student);

    $this->actingAs($student)
        ->get(route('purchase.show', $course->id))
        ->assertOk()
        ->assertViewIs('purchase')
        ->assertSee($course->title)
        ->assertSee('KES 5,500.00')
        ->assertSee('name="phone_number"', false)
        ->assertSee(
            route('purchase.course', $course->id),
            false
        );
});

test('guest cannot access enrollment checkout', function () {
    $course = checkoutGuardCourse();

    $this->get(route('purchase.show', $course->id))
        ->assertRedirect(route('login'));
});

test('student without enrollment cannot view checkout', function () {
    $student = User::factory()->create(['role' => 'student']);
    $course = checkoutGuardCourse();

    $this->actingAs($student)
        ->get(route('purchase.show', $course->id))
        ->assertForbidden();
});

test('student without enrollment cannot initiate payment', function () {
    $student = User::factory()->create(['role' => 'student']);
    $course = checkoutGuardCourse();

    $this->actingAs($student)
        ->post(route('purchase.course', $course->id), [
            'phone_number' => '254712345678',
        ])
        ->assertForbidden();
});

test('student cannot use another students enrollment', function () {
    $owner = User::factory()->create(['role' => 'student']);
    $other = User::factory()->create(['role' => 'student']);
    $course = checkoutGuardCourse();

    checkoutGuardEnrollment($owner);

    $this->actingAs($other)
        ->get(route('purchase.show', $course->id))
        ->assertForbidden();

    $this->actingAs($other)
        ->post(route('purchase.course', $course->id), [
            'phone_number' => '254712345678',
        ])
        ->assertForbidden();
});

test('non pending enrollment cannot initiate payment', function () {
    $student = User::factory()->create(['role' => 'student']);
    $course = checkoutGuardCourse();

    checkoutGuardEnrollment($student, 'cancelled');

    $this->actingAs($student)
        ->post(route('purchase.course', $course->id), [
            'phone_number' => '254712345678',
        ])
        ->assertForbidden();
});

test('paid enrollment redirects away from checkout', function () {
    $student = User::factory()->create(['role' => 'student']);
    $course = checkoutGuardCourse();

    checkoutGuardEnrollment($student, 'paid');

    $this->actingAs($student)
        ->get(route('purchase.show', $course->id))
        ->assertRedirect(route('classroom.show', $course->id));

    $this->actingAs($student)
        ->post(route('purchase.course', $course->id), [
            'phone_number' => '254712345678',
        ])
        ->assertRedirect(route('classroom.show', $course->id));
});
