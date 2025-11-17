<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\CareerApplication;
use Illuminate\Support\Facades\Storage;

class CareerApplicationController extends Controller
{
    public function apply(Request $request, Career $career)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cv_cover' => 'required|file|mimes:pdf|max:2048',
        ]);

        $path = $request->file('cv_cover')->store('career_applications', 'public');

        CareerApplication::create([
            'career_id' => $career->id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'cv_cover_path' => $path,
        ]);

        return back()->with('success', 'Your application has been submitted successfully!');
    }

    public function store(Request $request)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'position_slug' => 'nullable|string|max:255',
        'cv_cover' => 'required|file|mimes:pdf|max:5120', // 5MB
    ]);

    // Get career if slug provided
    $career = null;
    if ($request->position_slug) {
        $career = Career::where('slug', $request->position_slug)->first();
    }

    $path = $request->file('cv_cover')->store('career_applications', 'public');

    CareerApplication::create([
        'career_id' => $career?->id, // nullable
        'full_name' => $request->full_name,
        'email' => $request->email,
        'cv_cover_path' => $path,
        'position_slug' => $request->position_slug, // optional but useful
    ]);

    return back()->with('success', '✅ Your application has been submitted successfully!');
}

}
