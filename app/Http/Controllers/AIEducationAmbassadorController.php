<?php

namespace App\Http\Controllers;

use App\Models\AIEducationAmbassadorApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AIEducationAmbassadorController extends Controller
{
    public function show(): View
    {
        return view('pages.ai-education-ambassador');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_whatsapp' => ['required', 'string', 'max:50'],

            'employed_by_educational_institution' => [
                'required',
                'boolean',
            ],

            'institution_type' => [
                'nullable',
                'string',
                'max:255',
                'required_if:employed_by_educational_institution,1',
            ],

            'institution_name' => [
                'nullable',
                'string',
                'max:255',
                'required_if:employed_by_educational_institution,1',
            ],

            'city' => ['nullable', 'string', 'max:255'],
            'county' => ['nullable', 'string', 'max:255'],

            'current_position' => [
                'nullable',
                'string',
                'max:255',
                'required_if:employed_by_educational_institution,1',
            ],

            'tenure' => ['nullable', 'string', 'max:255'],

            'leadership_access' => [
                'nullable',
                'string',
                'max:255',
                'required_if:employed_by_educational_institution,1',
            ],

            'leadership_types' => [
                'nullable',
                'array',
            ],

            'leadership_types.*' => [
                'string',
                'max:255',
            ],

            'decision_maker_details' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'introduction_plan' => [
                'nullable',
                'string',
                'max:5000',
                'required_if:employed_by_educational_institution,1',
            ],
        ]);

        $application = AIEducationAmbassadorApplication::create([
            ...$validated,
            'status' => 'new',
        ]);

        return redirect()
            ->route('careers.ai-education-ambassador.success')
            ->with('application_reference', $application->application_reference);
    }

    public function success(): View
    {
        abort_unless(
            session()->has('application_reference'),
            404
        );

        return view('pages.ai-education-ambassador-success', [
            'applicationReference' => session('application_reference'),
        ]);
    }
}
