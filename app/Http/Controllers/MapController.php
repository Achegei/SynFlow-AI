<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MapController extends Controller
{
   public function map()
{
    $users =User::whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->get(['id', 'name', 'location', 'latitude', 'longitude']);

    return view('map', compact('users'));
}


}
