<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;

class UniversitySelectionController extends Controller
{
    /**
     * Show university selection page.
     */
    public function index()
    {
        $institutions = Institution::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view(
            'auth.choose-university',
            compact('institutions')
        );
    }

    /**
     * Store selected university.
     */
    public function store(Request $request)
    {
        $request->validate([
            'institution_id' => [
                'required',
                'exists:institutions,id',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Institution Registration Context
        |--------------------------------------------------------------------------
        */

        session()->put(
            'registration_context',
            'institution'
        );

        /*
        |--------------------------------------------------------------------------
        | Preserve Selected Institution
        |--------------------------------------------------------------------------
        */

        session()->put(
            'selected_institution_id',
            $request->institution_id
        );

        /*
        |--------------------------------------------------------------------------
        | Continue to Existing Registration
        |--------------------------------------------------------------------------
        */

        return redirect()->route('register');
    }
}