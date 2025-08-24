<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display the application form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showForm(Request $request)
    {
        // Get the position from the query parameter if it exists
        $position = $request->query('position', 'General Application');

        return view('pages.application', ['position' => $position]);
    }
}