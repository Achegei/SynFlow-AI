<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;

class UniversitySelectionController extends Controller
{
    /**
     * Show university selection page
     */
    public function index()
    {
        $institutions = Institution::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('auth.choose-university', compact('institutions'));
    }

    /**
     * Store selected university
     */
    public function store(Request $request)
    {
        $request->validate([
            'institution_id' => [
                'required',
                'exists:institutions,id'
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Save Institution In Session (FOR SAFETY)
        |--------------------------------------------------------------------------
        */
        session()->put('selected_institution_id', $request->institution_id);

        return redirect()->route('register');
    }
}