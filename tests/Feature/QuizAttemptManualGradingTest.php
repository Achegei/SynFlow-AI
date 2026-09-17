<?php

use App\Filament\Resources\QuizAttemptResource\Pages\EditQuizAttempt;
use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;

uses(RefreshDatabase::class);

function createManualGradingFixture(): array
{
    $now = now();

    $admin = User::factory()->create([
        'is_admin' => 1,
    ]);

    $student = User::factory()->create([
        'is_admin' => 0,
    ]);

    DB::table('courses')->insert([
        'id' => 1,
        'title' => 'Manual Grading Test Course',
        'description' => 'Test course.',
        'image_url' => null,
        'created_at' => $now,
        'updated_at' => $now,
    ]);

    DB::table('modules')->insert([
        'id' => 1,
        'course_id' => 1,
        'course_stage_id' => null,
        'title' => 'Final Examination',
        'description' => null,
        'position' => 1,
        'created_at' => $now,
        'updated_at' => $now,
    ]);

    DB::table('quizzes')->insert([
        'id' => 1,
        'module_id' => 1,
        'title' => 'Final Examination',
        'description' => null,
        'position' => 1,
        'created_at' => $now,
        'updated_at' => $now,
    ]);

    DB::table('quiz_questions')->insert([
        [
            'id' => 1,
            'quiz_id' => 1,
            'question' => 'Which format is commonly used for API data?',
            'type' => 'multiple_choice',
            'options' => json_encode([
                'A' => 'JSON',
                'B' => 'JPEG',
                'C' => 'MP3',
                'D' => 'PNG',
            ]),
            'correct_answer' => 'A',
            'max_points' => 1,
            'position' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'id' => 2,
            'quiz_id' => 1,
            'question' => 'Explain how you would diagnose a failed webhook.',
            'type' => 'short_answer',
            'options' => null,
            'correct_answer' => null,
            'max_points' => 2,
            'position' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'id' => 3,
            'quiz_id' => 1,
            'question' => 'Build and troubleshoot a small automation workflow.',
            'type' => 'practical',
            'options' => null,
            'correct_answer' => null,
            'max_points' => 10,
            'position' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ],
    ]);

    DB::table('quiz_attempts')->insert([
        'id' => 1,
        'user_id' => $student->id,
        'quiz_id' => 1,
        'score' => 0,
        'passed' => false,
        'status' => 'pending_review',
        'created_at' => $now,
        'updated_at' => $now,
    ]);

    DB::table('quiz_attempt_answers')->insert([
        [
            'id' => 1,
            'quiz_attempt_id' => 1,
            'quiz_question_id' => 1,
            'answer' => 'A',
            'is_correct' => true,
            'auto_graded' => true,
            'points_awarded' => 1,
            'review_feedback' => null,
            'reviewed_at' => $now,
            'reviewed_by' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'id' => 2,
            'quiz_attempt_id' => 1,
            'quiz_question_id' => 2,
            'answer' => 'I would inspect the webhook request, response and logs.',
            'is_correct' => null,
            'auto_graded' => false,
            'points_awarded' => null,
            'review_feedback' => null,
            'reviewed_at' => null,
            'reviewed_by' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ],
        [
            'id' => 3,
            'quiz_attempt_id' => 1,
            'quiz_question_id' => 3,
            'answer' => 'Practical workflow submission.',
            'is_correct' => null,
            'auto_graded' => false,
            'points_awarded' => null,
            'review_feedback' => null,
            'reviewed_at' => null,
            'reviewed_by' => null,
            'created_at' => $now,
            'updated_at' => $now,
        ],
    ]);

    $attempt = QuizAttempt::findOrFail(1);

    return [
        'admin' => $admin,
        'student' => $student,
        'attempt' => $attempt,
    ];
}

it('allows an administrator to manually grade written answers and finalize an examination attempt', function () {
    ['admin' => $admin, 'attempt' => $attempt] = createManualGradingFixture();

    $this->actingAs($admin);

    $panel = \Filament\Facades\Filament::getPanel('admin');
    \Filament\Facades\Filament::setCurrentPanel($panel);
    $panel->boot();

    $component = Livewire::test(EditQuizAttempt::class, [
        'record' => $attempt->getRouteKey(),
    ])
        ->assertSuccessful();

    $reviewAnswers = $component->get('data.review_answers');

    foreach ($reviewAnswers as $key => $row) {
        if ((int) $row['answer_id'] === 2) {
            $reviewAnswers[$key]['points_awarded'] = 2;
            $reviewAnswers[$key]['review_feedback'] = 'Clear troubleshooting process.';
        }

        if ((int) $row['answer_id'] === 3) {
            $reviewAnswers[$key]['points_awarded'] = 8;
            $reviewAnswers[$key]['review_feedback'] = 'Workflow works; monitoring could be improved.';
        }
    }

    $component
        ->set('data.review_answers', $reviewAnswers)
        ->call('save')
        ->assertHasNoFormErrors();

    // 1 + 2 + 8 = 11 points out of 13 available = 84.615...%, rounded to 85.
    $this->assertDatabaseHas('quiz_attempts', [
        'id' => 1,
        'score' => 85,
        'passed' => true,
        'status' => 'reviewed',
    ]);

    $this->assertDatabaseHas('quiz_attempt_answers', [
        'id' => 1,
        'points_awarded' => 1,
        'auto_graded' => true,
        'reviewed_by' => null,
    ]);

    $this->assertDatabaseHas('quiz_attempt_answers', [
        'id' => 2,
        'points_awarded' => 2,
        'review_feedback' => 'Clear troubleshooting process.',
        'reviewed_by' => $admin->id,
    ]);

    $this->assertDatabaseHas('quiz_attempt_answers', [
        'id' => 3,
        'points_awarded' => 8,
        'review_feedback' => 'Workflow works; monitoring could be improved.',
        'reviewed_by' => $admin->id,
    ]);

    expect(
        DB::table('quiz_attempt_answers')
            ->whereIn('id', [2, 3])
            ->whereNull('reviewed_at')
            ->count()
    )->toBe(0);
});

it('rejects marks above the database maximum and rolls back the entire review', function () {
    ['admin' => $admin, 'attempt' => $attempt] = createManualGradingFixture();

    $this->actingAs($admin);

    $panel = \Filament\Facades\Filament::getPanel('admin');
    \Filament\Facades\Filament::setCurrentPanel($panel);
    $panel->boot();

    $component = Livewire::test(EditQuizAttempt::class, [
        'record' => $attempt->getRouteKey(),
    ])
        ->assertSuccessful();

    $reviewAnswers = $component->get('data.review_answers');

    foreach ($reviewAnswers as $key => $row) {
        if ((int) $row['answer_id'] === 2) {
            $reviewAnswers[$key]['points_awarded'] = 2;
            $reviewAnswers[$key]['review_feedback'] = 'This update must be rolled back.';
        }

        if ((int) $row['answer_id'] === 3) {
            // Simulate tampering with the hidden client-side maximum.
            // The real database maximum for this question remains 10.
            $reviewAnswers[$key]['max_points'] = 100;
            $reviewAnswers[$key]['points_awarded'] = 11;
            $reviewAnswers[$key]['review_feedback'] = 'This mark must be rejected.';
        }
    }

    $component
        ->set('data.review_answers', $reviewAnswers)
        ->call('save')
        ->assertHasErrors(['review_answers']);

    $this->assertDatabaseHas('quiz_attempts', [
        'id' => 1,
        'score' => 0,
        'passed' => false,
        'status' => 'pending_review',
    ]);

    $this->assertDatabaseHas('quiz_attempt_answers', [
        'id' => 2,
        'points_awarded' => null,
        'review_feedback' => null,
        'reviewed_at' => null,
        'reviewed_by' => null,
    ]);

    $this->assertDatabaseHas('quiz_attempt_answers', [
        'id' => 3,
        'points_awarded' => null,
        'review_feedback' => null,
        'reviewed_at' => null,
        'reviewed_by' => null,
    ]);
});
