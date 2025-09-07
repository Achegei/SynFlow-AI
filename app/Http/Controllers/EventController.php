<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'event_date' => 'required|date',
        'start_time' => 'nullable|date_format:H:i',
        'end_time'   => 'nullable|date_format:H:i|after_or_equal:start_time',
        'title'      => 'required|string|max:255',
        'description'=> 'nullable|string',
        'link'       => 'nullable|url',
        'is_live'    => 'boolean',
    ]);

    Event::create([
        'user_id'     => Auth::id(),
        'event_date'  => $request->event_date,
        'start_time'  => $request->start_time,
        'end_time'    => $request->end_time,
        'title'       => $request->title,
        'description' => $request->description,
        'link'        => $request->link,
        'is_live'     => $request->boolean('is_live'),
    ]);

    return back()->with('success', 'Event booked successfully!');
}

}
