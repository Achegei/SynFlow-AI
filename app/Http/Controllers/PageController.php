<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Contact;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function faqs(): View
    {
        return view('pages.faq');
    } 

    public function about(): View
    {
        return view('pages.about');
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function terms(): View
    {
        return view('pages.terms');
    }

    public function policy(): View
    {
        return view('pages.privacy-policy');
    }

    // ==============================
    // Contact Page (GET + POST)
    // ==============================
    public function contact(): View
    {
        return view('pages.contactus'); // This is your existing Blade
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'company_website' => 'nullable|url|max:255',
            'company_size' => 'nullable|string|max:50',
            'revenue' => 'nullable|string|max:50',
            'budget' => 'nullable|string|max:50',
            'services' => 'nullable|array',
            'message' => 'nullable|string|max:2000',
        ]);

        // Store in database
        Contact::create($validated);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Thank you! Your message has been sent.');
    }
    // ==============================
    // Other Pages (unchanged)
    // ==============================
    public function careers(): View
    {
        return view('pages.careers');
    }

    public function pricing(): View
    {
        return view('pages.pricing');
    }

    public function documentation(): View
    {
        return view('pages.documentation');
    }

    public function introduction(): View
    {
        return view('pages.introduction');
    }

    public function technology(): View
    {
        return view('pages.technology-stack');
    }

    public function processes(): View
    {
        return view('pages.processes');
    }

    public function agents(): View
    {
        return view('pages.agents');
    }

    public function assistant(): View
    {
        return view('pages.assistant');
    }

    public function research(): View
    {
        return view('pages.deep-research');
    }

    public function newsletter(): View
    {
        return view('pages.newsletter');
    }

    public function rag(): View
    {
        return view('pages.rag_pipeline');
    }

    public function shorts(): View
    {
        return view('pages.faceless-shorts');
    }
}
