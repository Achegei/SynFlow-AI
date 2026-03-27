<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnerApplicationController extends Controller
{
    /**
     * Store a new partner application
     */
    public function store(Request $request)
    {
        // Validate incoming form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'location' => 'nullable|string|max:255',
            'current_student_population' => 'nullable|string|max:255',
            'additional_info' => 'nullable|string',
        ]);

        // Insert into partner_applications table
        DB::table('partner_applications')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'location' => $request->location,
            'current_student_population' => $request->current_student_population,
            'additional_info' => $request->additional_info,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', '🎉 Application submitted successfully! We will contact you soon.');
    }
}