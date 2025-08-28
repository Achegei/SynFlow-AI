<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Episode;

class CourseAdminController extends Controller
{
    /**
     * Show the form for creating a new course.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created course and its episodes in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request data
        $validatedCourse = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url',
        ]);

        // 2. Create the new course
        $course = Course::create($validatedCourse);

        // 3. Validate and save each video (episode)
        $validatedEpisodes = $request->validate([
            'episodes.*.title' => 'required|string|max:255',
            'episodes.*.description' => 'required|string',
            'episodes.*.video_url' => 'required|url',
        ]);

        // 4. Loop through the validated episodes and save them to the database
        foreach ($validatedEpisodes['episodes'] as $episodeData) {
            $course->episodes()->create($episodeData);
        }

        // 5. Redirect back to a page, perhaps the course list with a success message
        return redirect()->route('classroom.index')->with('success', 'Course and videos added successfully!');
    }
}
