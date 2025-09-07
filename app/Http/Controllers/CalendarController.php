<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Event;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        // Get month from query or default to current month
        $monthParam = $request->query('month', Carbon::now()->format('Y-m'));
        $date = Carbon::createFromFormat('Y-m', $monthParam);

        // Prepare variables
        $month = $date->format('F Y'); // e.g. "September 2025"
        $daysInMonth = $date->daysInMonth;

        // Fetch events for this month
        $events = Event::whereMonth('event_date', $date->month)
                       ->whereYear('event_date', $date->year)
                       ->get()
                       ->groupBy('event_date');

        // Pass variables to the view
        return view('calendar', compact('month', 'date', 'daysInMonth', 'events'));
    }
}
