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
}