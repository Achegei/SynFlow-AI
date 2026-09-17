<?php

use App\Models\Course;
use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the paywall and hides protected curriculum for a learner without course access', function () {
    $user = User::factory()->create();

    $course = Course::query()->create([
        'title' => 'Artificial Intelligence & Automation Systems (AI & Workflow Automation)',
        'description' => 'Protected production course.',
    ]);

    expect($course->id)->toBe(1);

    Module::query()->create([
        'course_id' => $course->id,
        'title' => 'PROTECTED ADVANCED MODULE',
        'position' => 1,
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('classroom.show', $course->id));

    $response
        ->assertOk()
        ->assertSee('Access Required')
        ->assertSee('Course Access Required')
        ->assertSee('Unlock This Course')
        ->assertSee('Pay KES 10,000 with M-PESA')
        ->assertDontSee('Learning in Progress')
        ->assertDontSee('Continue where you left off')
        ->assertDontSee('PROTECTED ADVANCED MODULE');
});

it('shows the classroom and hides the paywall for a learner with permanent course access', function () {
    $user = User::factory()->create();

    $course = Course::query()->create([
        'title' => 'Artificial Intelligence & Automation Systems (AI & Workflow Automation)',
        'description' => 'Protected production course.',
    ]);

    expect($course->id)->toBe(1);

    Module::query()->create([
        'course_id' => $course->id,
        'title' => 'PROTECTED ADVANCED MODULE',
        'position' => 1,
    ]);

    $user->courses()->attach($course->id);

    $response = $this
        ->actingAs($user)
        ->get(route('classroom.show', $course->id));

    $response
        ->assertOk()
        ->assertSee('Learning in Progress')
        ->assertSee('Course Progress')
        ->assertSee('PROTECTED ADVANCED MODULE')
        ->assertDontSee('Course Access Required')
        ->assertDontSee('Unlock This Course')
        ->assertDontSee('Pay KES 10,000 with M-PESA');
});
