<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\CareerApplication;

class CareerApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'position'      => 'required|string|max:255',
            'position_slug' => 'required|string|max:255',
            'cv_cover'      => 'required|file|mimes:pdf|max:5120',
        ]);

        // If position_slug matches a career entry
        $careerId = null;
        if ($request->filled('position_slug')) {
            $career = Career::where('slug', $request->position_slug)->first();
            if ($career) {
                $careerId = $career->id;
            }
        }

        // Upload CV
        $cvPath = $request->file('cv_cover')->store('career_applications/cv', 'public');

        // Save full application including position
        // app/Http/Controllers/CareerApplicationController.php
            CareerApplication::create([
                'career_id'     => $careerId, // optional, matched by slug
                'full_name'     => $request->full_name,
                'email'         => $request->email,
                'position'      => $request->position,       // <-- add this
                'position_slug' => $request->position_slug,  // <-- add this
                'cv_cover_path' => $cvPath,
            ]);


        return back()->with('success', '✅ Your application has been submitted successfully!');
    }
}
