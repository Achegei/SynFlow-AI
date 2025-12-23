<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the courses.
     *
     * @return \Illuminate\View\View
     */
 public function show($id)
{
    $course = Course::with('episodes')->findOrFail($id);
    $user = auth()->user();

    // ✅ 1. Ensure user is logged in
    if (!$user) {
        return redirect()->route('login')
            ->with('error', 'Please log in to access this course.');
    }

    // ✅ 2. Access control
    $isFreeCourse = (int) $course->id === 1;

    if (!$isFreeCourse && !$user->courses->contains($course->id)) {
        return redirect()
            ->route('purchase.course', $course->id)
            ->with('error', 'You need to purchase this course to access it.');
    }

    // ✅ 3. Calculate user progress
    $episodes = $course->episodes;
    $totalEpisodes = $episodes->count();

    $completedEpisodes = $episodes
        ->filter(fn ($e) => $e->is_completed)
        ->count();

    $course->progress_percentage = $totalEpisodes > 0
        ? ($completedEpisodes / $totalEpisodes) * 100
        : 0;

    // ✅ 4. Return view
    return view('classroom.course-details', compact('course', 'episodes'));
}

    public function index()
    {
        // Fetch all courses
        $courses = Course::with('episodes')->get();

        // Optionally calculate a fake progress for now
        foreach ($courses as $course) {
            $totalEpisodes = $course->episodes->count();
            $completedEpisodes = 0; // Later link this to user progress
            $course->progress_percentage = $totalEpisodes > 0 
                ? ($completedEpisodes / $totalEpisodes) * 100 
                : 0;
        }

        // Pass $courses to the Blade view
        return view('classroom.index', compact('courses'));
    }

}
