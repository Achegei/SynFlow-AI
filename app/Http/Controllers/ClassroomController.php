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
    public function index()
    {
        // Fetch all courses from the database.
        $courses = Course::all();

        // NOTE: The progress_percentage should be calculated for each user.
        // This is a simplified example. A more robust solution would track user
        // progress in a pivot table (e.g., user_episode_completions).
        foreach ($courses as $course) {
            $totalEpisodes = $course->episodes->count();
            $completedEpisodes = 0; // This should be fetched from a user's progress table
            $course->progress_percentage = $totalEpisodes > 0 ? ($completedEpisodes / $totalEpisodes) * 100 : 0;
        }

        return view('classroom.index', compact('courses'));
    }

    /**
     * Display the specified course with its episodes.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Fetch the course and its episodes from the database.
        $course = Course::with('episodes')->findOrFail($id);
        $episodes = $course->episodes;

        // NOTE: A real implementation would check the authenticated user's progress.
        foreach ($episodes as $episode) {
            $episode->is_completed = false; // This should be fetched from a user's progress table
        }
        
        // Calculate the overall course progress.
        $totalEpisodes = $episodes->count();
        $completedEpisodes = $episodes->filter(fn($e) => $e->is_completed)->count();
        $course->progress_percentage = $totalEpisodes > 0 ? ($completedEpisodes / $totalEpisodes) * 100 : 0;

        return view('classroom.course-details', compact('course', 'episodes'));
    }
}
