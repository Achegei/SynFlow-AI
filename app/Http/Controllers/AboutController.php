<?php

namespace App\Http\Controllers;

use App\Models\User;

class AboutController extends Controller
{
    public function index()
    {
        $members = User::count();
        $online = User::where('is_online', true)->count();

        return view('about-auth', compact('members', 'online'));
    }
}
