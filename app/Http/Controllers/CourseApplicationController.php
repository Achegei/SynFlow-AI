<?php

namespace App\Http\Controllers;

use App\Models\CourseApplication;
use Illuminate\Http\Request;

class CourseApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'has_laptop' => 'required',
        ]);

        // Prevent submission if applicant has no laptop
        if ($request->has_laptop === 'No') {
            return back()->withInput()->with('error', 'A laptop is required to join this course. Please apply when you have one.');
        }

        CourseApplication::create($request->all());

        return back()->with('success', '🎉 Application submitted successfully! We will contact you soon.');
    }
}