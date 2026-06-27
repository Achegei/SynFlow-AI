<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\User;
use App\Models\Payment;

class InstitutionDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (! $user) {
            abort(403, 'Unauthorized');
        }

        /*
        |--------------------------------------------------------------------------
        | Institution
        |--------------------------------------------------------------------------
        */

        $institution = Institution::with('salesExecutive')
            ->find($user->institution_id);

        if (! $institution) {
            abort(403, 'No institution linked to this account');
        }

        /*
        |--------------------------------------------------------------------------
        | Student IDs (ALL students)
        |--------------------------------------------------------------------------
        */

        $studentIds = User::where('institution_id', $institution->id)
            ->where('role', 'student')
            ->pluck('id');

        /*
        |--------------------------------------------------------------------------
        | Students Table (Paginated)
        |--------------------------------------------------------------------------
        */

        $students = User::where('institution_id', $institution->id)
            ->where('role', 'student')
            ->latest()
            ->paginate(10);

        /*
        |--------------------------------------------------------------------------
        | Payments (ALL students)
        |--------------------------------------------------------------------------
        */

        $payments = Payment::whereIn('user_id', $studentIds)
            ->where('status', 'paid')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Revenue
        |--------------------------------------------------------------------------
        */

        $totalRevenue = $payments->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | Shares
        |--------------------------------------------------------------------------
        */

        $institutionShare = $institution->wallet_balance;

        $platformShare = $totalRevenue - $institutionShare;

        /*
        |--------------------------------------------------------------------------
        | Activity Statistics
        |--------------------------------------------------------------------------
        */

        $activeToday = User::where('institution_id', $institution->id)
            ->where('role', 'student')
            ->whereDate('last_activity_at', today())
            ->count();

        $activeThisWeek = User::where('institution_id', $institution->id)
            ->where('role', 'student')
            ->where('last_activity_at', '>=', now()->subDays(7))
            ->count();

        $inactiveStudents = User::where('institution_id', $institution->id)
            ->where('role', 'student')
            ->where(function ($query) {
                $query->whereNull('last_activity_at')
                      ->orWhere('last_activity_at', '<', now()->subDays(14));
            })
            ->count();

        return view('dashboards.institution', [

            'institution' => $institution,

            'students' => $students,

            'totalRevenue' => $totalRevenue,

            'institutionShare' => $institutionShare,

            'platformShare' => $platformShare,

            'activeToday' => $activeToday,

            'activeThisWeek' => $activeThisWeek,

            'inactiveStudents' => $inactiveStudents,

        ]);
    }
}