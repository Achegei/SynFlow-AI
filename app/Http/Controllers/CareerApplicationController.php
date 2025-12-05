<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\CareerApplication;

class CareerApplicationController extends Controller
{
    /**
     * Apply via career/{career}
     */
    public function apply(Request $request, Career $career)
    {
        $request->validate([
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',

            // Your exact Blade field names
            'cv_cover'      => 'required|file|mimes:pdf|max:5120',   // 5MB
            'certificate'   => 'required|file|mimes:pdf|max:5120',   // 5MB
        ]);

        // Store CV + Cover Letter
        $cvPath = $request->file('cv_cover')->store('career_applications/cv', 'public');

        // Store Certificate
        $certificatePath = $request->file('certificate')->store('career_applications/certificates', 'public');

        CareerApplication::create([
            'career_id'        => $career->id,
            'full_name'        => $request->full_name,
            'email'            => $request->email,
            'cv_cover_path'    => $cvPath,
            'certificate_path' => $certificatePath,
        ]);

        return back()->with('success', 'Your application has been submitted successfully!');
    }

    /**
     * Apply via general form (store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'position_slug' => 'nullable|string|max:255',

            // Your exact field names
            'cv_cover'      => 'required|file|mimes:pdf|max:5120',
            'certificate'   => 'required|file|mimes:pdf|max:5120',
        ]);

        // Fetch career if slug provided
        $career = null;
        if ($request->position_slug) {
            $career = Career::where('slug', $request->position_slug)->first();
        }

        // Upload CV + Cover Letter
        $cvPath = $request->file('cv_cover')->store('career_applications/cv', 'public');

        // Upload Certificate
        $certificatePath = $request->file('certificate')->store('career_applications/certificates', 'public');

        CareerApplication::create([
            'career_id'        => $career?->id,
            'full_name'        => $request->full_name,
            'email'            => $request->email,
            'cv_cover_path'    => $cvPath,
            'certificate_path' => $certificatePath,
            'position_slug'    => $request->position_slug,
        ]);

        return back()->with('success', '✅ Your application has been submitted successfully!');
    }
}
