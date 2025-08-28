<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a listing of all career opportunities.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all career opportunities from the database.
        $careers = Career::all();

        // Return the 'careers' view, passing the careers data to it.
        return view('pages.careers', compact('careers'));
    }

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
