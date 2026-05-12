<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Episode;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the courses.
     *
     * @return \Illuminate\View\View
     */
 public function show($id)
{
    $course = Course::with([
        'modules.episodes',
        'modules.quizzes.questions',
        'modules.assignments'
    ])->findOrFail($id);

    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login')
            ->with('error', 'Please log in to access this course.');
    }

    $isFreeCourse = (int) $course->id === 1;

    if (!$isFreeCourse && !$user->courses->contains($course->id)) {
        return redirect()
            ->route('purchase.course', $course->id)
            ->with('error', 'You need to purchase this course to access it.');
    }

    // FIXED: get episodes correctly from modules
    $episodes = $course->modules->flatMap->episodes;
    $totalEpisodes = $episodes->count();

    $completedEpisodes = $episodes
        ->filter(fn ($e) => $e->is_completed)
        ->count();

    $course->progress_percentage = $totalEpisodes > 0
        ? ($completedEpisodes / $totalEpisodes) * 100
        : 0;

    return view('classroom.course-details', compact('course', 'episodes'));
}
   public function index()
{
    $courses = Course::with('modules.episodes')->get();

    foreach ($courses as $course) {

        $totalEpisodes = $course->modules
            ->flatMap->episodes
            ->count();

        $course->progress_percentage = 0; // later user-based
    }

    return view('classroom.index', compact('courses'));
}
}
