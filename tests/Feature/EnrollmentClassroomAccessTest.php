<?php

use App\Models\Course;
use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('protects the configured enrollment course and displays the correct fee', function () {
    config()->set('enrollment.course_id', 9);
    config()->set('enrollment.fee', 5500.00);

    $user = User::factory()->create();

    $course = Course::query()->forceCreate([
        'id' => 9,
        'title' => 'Artificial Intelligence & Automation Systems (AI & Workflow Automation)',
        'description' => 'Protected enrollment course.',
        'price' => 0,
    ]);

    expect($course->id)->toBe(9);

    Module::query()->create([
        'course_id' => $course->id,
        'title' => 'ENROLLMENT PROTECTED MODULE',
        'position' => 1,
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('classroom.show', $course->id));

    $response
        ->assertOk()
        ->assertSee('Access Required')
        ->assertSee('Course Access Required')
        ->assertSee('KES 5,500')
        ->assertDontSee('KES 10,000')
        ->assertDontSee('Learning in Progress')
        ->assertDontSee('ENROLLMENT PROTECTED MODULE');
});
