<?php

use App\Models\Course;
use App\Models\Episode;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->corporateCourse = Course::query()->forceCreate([
        'id' => 2,
        'title' => 'Corporate AI Ethics, Governance & Responsible AI in the Workplace',
        'description' => 'Corporate and institutional AI governance training.',
        'price' => 0,
    ]);

    expect($this->corporateCourse->id)->toBe(2);
});

it('makes corporate training discoverable without granting course access', function () {
    $response = $this->actingAs($this->user)
        ->get(route('classroom'));

    $response->assertOk()
        ->assertSee('Corporate Training Only')
        ->assertSee('Enquire About Training');
});

it('shows the corporate enquiry page instead of course lessons', function () {
    $response = $this->actingAs($this->user)
        ->get(route('classroom.show', 2));

    $response->assertOk()
        ->assertSee('Enquire About Corporate Training')
        ->assertSee('aisolutions@mooseloonai.ca')
        ->assertSee('Office B20B')
        ->assertDontSee('Mark as Watched');
});

it('blocks direct corporate course checkout', function () {
    $this->actingAs($this->user)
        ->get(route('purchase.show', 2))
        ->assertForbidden();
});

it('blocks direct corporate course payment initiation', function () {
    $this->actingAs($this->user)
        ->post(route('purchase.course', 2), [
            'phone' => '0712345678',
        ])
        ->assertForbidden();
});

it('blocks corporate course payment completion access', function () {
    $this->actingAs($this->user)
        ->get(route('purchase.complete', 2))
        ->assertForbidden();
});

it('blocks corporate self-service certificate generation', function () {
    $this->actingAs($this->user)
        ->get(route('certificate.generate', 2))
        ->assertForbidden();
});

it('blocks corporate certificate downloads', function () {
    $this->actingAs($this->user)
        ->post(route('certificate.download', 2), [
            'full_name' => 'Test Learner',
        ])
        ->assertForbidden();
});

it('blocks corporate episode watched updates even for enrolled learners', function () {
    $module = Module::query()->create([
        'course_id' => $this->corporateCourse->id,
        'title' => 'Restricted corporate module',
        'position' => 1,
    ]);

    $episode = Episode::query()->create([
        'module_id' => $module->id,
        'title' => 'Restricted corporate episode',
        'video_url' => 'https://www.youtube.com/watch?v=test',
        'position' => 1,
    ]);

    $this->user->courses()->attach($this->corporateCourse->id);

    $this->actingAs($this->user)
        ->postJson(route('episodes.markWatched', $episode))
        ->assertForbidden();

    expect($this->user->episodes()
        ->where('episode_id', $episode->id)
        ->exists())->toBeFalse();
});

it('blocks corporate episode toggles even for enrolled learners', function () {
    $module = Module::query()->create([
        'course_id' => $this->corporateCourse->id,
        'title' => 'Restricted corporate module',
        'position' => 1,
    ]);

    $episode = Episode::query()->create([
        'module_id' => $module->id,
        'title' => 'Restricted corporate episode',
        'video_url' => 'https://www.youtube.com/watch?v=test',
        'position' => 1,
    ]);

    $this->user->courses()->attach($this->corporateCourse->id);

    $this->actingAs($this->user)
        ->post(route('episodes.toggle', $episode))
        ->assertForbidden();

    expect($this->user->episodes()
        ->where('episode_id', $episode->id)
        ->exists())->toBeFalse();
});

it('blocks corporate quiz viewing even for enrolled learners', function () {
    $module = Module::query()->create([
        'course_id' => $this->corporateCourse->id,
        'title' => 'Restricted corporate module',
        'position' => 1,
    ]);

    $quiz = Quiz::query()->create([
        'module_id' => $module->id,
        'title' => 'Restricted corporate quiz',
        'position' => 1,
    ]);

    $this->user->courses()->attach($this->corporateCourse->id);

    $this->actingAs($this->user)
        ->get(route('quizzes.show', $quiz))
        ->assertForbidden();
});

it('blocks corporate quiz submission even for enrolled learners', function () {
    $module = Module::query()->create([
        'course_id' => $this->corporateCourse->id,
        'title' => 'Restricted corporate module',
        'position' => 1,
    ]);

    $quiz = Quiz::query()->create([
        'module_id' => $module->id,
        'title' => 'Restricted corporate quiz',
        'position' => 1,
    ]);

    $this->user->courses()->attach($this->corporateCourse->id);

    $this->actingAs($this->user)
        ->postJson(route('quizzes.submit', $quiz), [
            'answers' => [],
        ])
        ->assertForbidden();
});
