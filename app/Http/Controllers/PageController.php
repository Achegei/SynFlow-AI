<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // <-- Add this import

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
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
    public function contact(): View
    {
        return view('pages.contactus');
    }
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