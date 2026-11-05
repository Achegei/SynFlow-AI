<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Contact;
use App\Models\GalleryImage;

class PageController extends Controller
{
    public function home(): View
    {
        $institutionalPartners = \App\Models\Institution::query()
            ->where('status', 'active')
            ->where('show_on_homepage', true)
            ->orderBy('display_order')
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'logo_path',
                'website_url',
                'public_description',
            ]);

        $featuredGalleryImages = GalleryImage::query()
            ->featured()
            ->orderBy('display_order')
            ->orderByDesc('published_at')
            ->limit(6)
            ->get();

        return view('pages.home', [
            'institutionalPartners' => $institutionalPartners,
            'featuredGalleryImages' => $featuredGalleryImages,
        ]);
    }

    public function gallery(Request $request): View
    {
        $type = $request->query('type', 'all');

        if (! is_string($type) || ! in_array($type, ['all', 'photos', 'videos'], true)) {
            $type = 'all';
        }

        $query = GalleryImage::query()->published();

        if ($type === 'photos') {
            $query->where('media_type', 'photo');
        } elseif ($type === 'videos') {
            $query->whereIn('media_type', ['video_upload', 'youtube']);
        }

        $galleryImages = $query
            ->orderBy('display_order')
            ->orderByDesc('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('pages.gallery', [
            'galleryImages' => $galleryImages,
            'galleryType' => $type,
        ]);
    }

    public function faqs(): View
    {
        return view('pages.faq');
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

    public function partners(): View
{
    return view('pages.partners');
}
}
