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
            'registration_context' => [
                'required',
                'in:institution,other',
            ],
            'institution_id' => [
                'required_if:registration_context,institution',
                'nullable',
                'exists:institutions,id',
            ],
        ]);

        if ($request->input('registration_context') === 'other') {
            session()->forget('selected_institution_id');

            session()->put('registration_context', 'other');

            return redirect()->route('register');
        }

        $institution = Institution::query()
            ->whereKey($request->institution_id)
            ->where('status', 'active')
            ->first();

        if (!$institution) {
            return back()
                ->withInput()
                ->withErrors([
                    'institution_id' => 'Please select an active institution.',
                ]);
        }

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