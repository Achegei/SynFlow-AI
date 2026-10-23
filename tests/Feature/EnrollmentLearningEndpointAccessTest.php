<?php

use App\Models\Course;
use App\Models\Episode;
use App\Models\LearningAccess;
use App\Models\Package;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    config()->set('enrollment.course_id', 9);

    $this->learner = User::factory()->create();

    $this->course = Course::query()->forceCreate([
        'id' => 9,
        'title' => 'Artificial Intelligence & Automation Systems (AI & Workflow Automation)',
        'description' => 'Protected enrollment course.',
        'price' => 0,
    ]);

    $this->module = Module::query()->create([
        'course_id' => $this->course->id,
        'title' => 'Protected learning module',
        'position' => 1,
    ]);

    $this->episode = Episode::query()->create([
        'module_id' => $this->module->id,
        'title' => 'Protected learning episode',
        'video_url' => 'https://www.youtube.com/watch?v=test',
        'position' => 1,
    ]);

    $this->quiz = Quiz::query()->create([
        'module_id' => $this->module->id,
        'title' => 'Protected learning quiz',
        'position' => 1,
    ]);
});

it('denies unpaid learners access to episode watched updates', function () {
    $this->actingAs($this->learner)
        ->postJson(route('episodes.markWatched', $this->episode))
        ->assertForbidden();

    expect(
        $this->learner->episodes()
            ->where('episode_id', $this->episode->id)
            ->exists()
    )->toBeFalse();
});

it('denies unpaid learners access to episode toggles', function () {
    $this->actingAs($this->learner)
        ->post(route('episodes.toggle', $this->episode))
        ->assertForbidden();

    expect(
        $this->learner->episodes()
            ->where('episode_id', $this->episode->id)
            ->exists()
    )->toBeFalse();
});

it('denies unpaid learners access to quiz content', function () {
    $this->actingAs($this->learner)
        ->get(route('quizzes.show', $this->quiz))
        ->assertForbidden();
});

it('redirects authorized learners to the requested classroom quiz', function () {
    $this->learner->courses()->attach($this->course->id);

    $this->actingAs($this->learner)
        ->get(route('quizzes.show', $this->quiz))
        ->assertRedirect(route('classroom.show', [
            'id' => $this->course->id,
            'quiz' => $this->quiz->id,
        ]));
});

it('continues denying unpaid learners access to standalone quiz links', function () {
    $this->actingAs($this->learner)
        ->get(route('quizzes.show', $this->quiz))
        ->assertForbidden();
});

it('renders classroom quiz deep-link initialization for authorized learners', function () {
    $this->learner->courses()->attach($this->course->id);

    $this->actingAs($this->learner)
        ->get(route('classroom.show', [
            'id' => $this->course->id,
            'quiz' => $this->quiz->id,
        ]))
        ->assertOk()
        ->assertSee('quiz-panel-' . $this->quiz->id, false)
        ->assertSee("window.showLearningItem('quiz', requestedQuizId)", false);
});

it('denies unpaid learners access to quiz submission', function () {
    $this->actingAs($this->learner)
        ->postJson(route('quizzes.submit', $this->quiz), [
            'answers' => [],
        ])
        ->assertForbidden();
});


it('allows permanently enrolled learners to update episode progress', function () {
    $this->learner->courses()->attach($this->course->id);

    $this->actingAs($this->learner)
        ->postJson(route('episodes.markWatched', $this->episode))
        ->assertOk()
        ->assertJsonPath('status', 'success');

    expect(
        $this->learner->episodes()
            ->where('episode_id', $this->episode->id)
            ->wherePivot('watched', true)
            ->exists()
    )->toBeTrue();
});

it('allows permanently enrolled learners to toggle episode progress', function () {
    $this->learner->courses()->attach($this->course->id);

    $this->actingAs($this->learner)
        ->post(route('episodes.toggle', $this->episode))
        ->assertRedirect();

    expect(
        $this->learner->episodes()
            ->where('episode_id', $this->episode->id)
            ->wherePivot('watched', true)
            ->exists()
    )->toBeTrue();
});

it('allows permanently enrolled learners to submit a quiz', function () {
    $this->learner->courses()->attach($this->course->id);

    $this->actingAs($this->learner)
        ->postJson(route('quizzes.submit', $this->quiz), [
            'answers' => [],
        ])
        ->assertOk()
        ->assertJsonPath('success', true);
});

it('preserves episode progress access for ordinary free courses', function () {
    $freeCourse = Course::query()->forceCreate([
        'id' => 20,
        'title' => 'Ordinary free course',
        'description' => 'Free course regression fixture.',
        'price' => 0,
    ]);

    $freeModule = Module::query()->create([
        'course_id' => $freeCourse->id,
        'title' => 'Free module',
        'position' => 1,
    ]);

    $freeEpisode = Episode::query()->create([
        'module_id' => $freeModule->id,
        'title' => 'Free episode',
        'video_url' => 'https://www.youtube.com/watch?v=free',
        'position' => 1,
    ]);

    $this->actingAs($this->learner)
        ->postJson(route('episodes.markWatched', $freeEpisode))
        ->assertOk()
        ->assertJsonPath('status', 'success');
});

it('continues protecting the historical paid course', function () {
    $legacyCourse = Course::query()->forceCreate([
        'id' => 1,
        'title' => 'Historical paid course',
        'description' => 'Legacy paid-course regression fixture.',
    ]);

    $legacyModule = Module::query()->create([
        'course_id' => $legacyCourse->id,
        'title' => 'Historical protected module',
        'position' => 1,
    ]);

    $legacyQuiz = Quiz::query()->create([
        'module_id' => $legacyModule->id,
        'title' => 'Historical protected quiz',
        'position' => 1,
    ]);

    $this->actingAs($this->learner)
        ->postJson(route('quizzes.submit', $legacyQuiz), [
            'answers' => [],
        ])
        ->assertForbidden();
});


function createEnrollmentTestSubscription(
    User $user,
    Course $course,
    string $status,
    \Illuminate\Support\Carbon $startsAt,
    \Illuminate\Support\Carbon $expiresAt
): LearningAccess {
    $package = Package::query()->create([
        'course_id' => $course->id,
        'name' => 'Authorization Test Package',
        'slug' => 'authorization-test-package-' . $user->id,
        'duration_days' => 7,
        'price' => 1049,
        'active' => true,
        'sort_order' => 1,
    ]);

    return LearningAccess::query()->create([
        'user_id' => $user->id,
        'course_id' => $course->id,
        'package_id' => $package->id,
        'starts_at' => $startsAt,
        'expires_at' => $expiresAt,
        'status' => $status,
    ]);
}

it('allows learners with active AI subscriptions to update episode progress', function () {
    createEnrollmentTestSubscription(
        $this->learner,
        $this->course,
        'active',
        now()->subDay(),
        now()->addDays(6)
    );

    $this->actingAs($this->learner)
        ->postJson(route('episodes.markWatched', $this->episode))
        ->assertOk()
        ->assertJsonPath('status', 'success');
});

it('denies learners with expired AI subscriptions', function () {
    createEnrollmentTestSubscription(
        $this->learner,
        $this->course,
        'active',
        now()->subDays(8),
        now()->subDay()
    );

    $this->actingAs($this->learner)
        ->postJson(route('episodes.markWatched', $this->episode))
        ->assertForbidden();
});

it('denies learners with inactive AI subscriptions', function () {
    createEnrollmentTestSubscription(
        $this->learner,
        $this->course,
        'expired',
        now()->subDay(),
        now()->addDays(6)
    );

    $this->actingAs($this->learner)
        ->postJson(route('episodes.markWatched', $this->episode))
        ->assertForbidden();
});

it('denies learners whose AI subscriptions have not started', function () {
    createEnrollmentTestSubscription(
        $this->learner,
        $this->course,
        'active',
        now()->addDay(),
        now()->addDays(8)
    );

    $this->actingAs($this->learner)
        ->postJson(route('episodes.markWatched', $this->episode))
        ->assertForbidden();
});
