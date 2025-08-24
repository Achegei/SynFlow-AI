<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a specific career opportunity.
     *
     * @param  string  $position The job title slug.
     * @return \Illuminate\View\View
     */
    public function show($position)
    {
        // Use the Career model to query the database and find the career by its slug.
        // firstOrFail() will automatically return a 404 page if not found.
        $career = Career::where('slug', $position)->firstOrFail();

        return view('pages.job-description', compact('career'));
    }
}
