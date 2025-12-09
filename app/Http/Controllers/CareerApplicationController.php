<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\CareerApplication;
use Illuminate\Support\Facades\Mail;   // <-- add this
use App\Mail\CareerApplicationReceived; // <-- add this

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
        $application = CareerApplication::create([
            'career_id'     => $careerId,
            'full_name'     => $request->full_name,
            'email'         => $request->email,
            'position'      => $request->position,
            'position_slug' => $request->position_slug,
            'cv_cover_path' => $cvPath,
        ]);

        // 🎉 SEND AUTO-CONFIRMATION EMAIL
        Mail::to($request->email)->send(
            new CareerApplicationReceived(
                $request->full_name,
                $request->position
            )
        );

        return back()->with('success', '✅ Your application has been submitted successfully!');
    }
}
