<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\User;
use App\Models\Payment;

class InstitutionDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Unauthorized');
        }

        /*
        |--------------------------------------------------------------------------
        | FIX 1: Safely load institution
        |--------------------------------------------------------------------------
        */

        $institution = Institution::with(['salesExecutive'])
            ->find($user->institution_id);

        if (!$institution) {
            abort(403, 'No institution linked to this account');
        }

        /*
        |--------------------------------------------------------------------------
        | Students
        |--------------------------------------------------------------------------
        */

        $students = User::where('institution_id', $institution->id)
            ->where('role', 'student')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | FIX 2: Correct payment status
        |--------------------------------------------------------------------------
        */

        $payments = Payment::whereIn('user_id', $students->pluck('id'))
            ->where('status', 'paid') // FIXED (was "success")
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Revenue
        |--------------------------------------------------------------------------
        */

        $totalRevenue = $payments->sum('amount');
        $institutionShare = $institution->wallet_balance ?? ($totalRevenue * 0.40);

        return view('dashboards.institution', [
            'institution' => $institution,
            'students' => $students,
            'totalRevenue' => $totalRevenue,
            'institutionShare' => $institutionShare,
        ]);
    }
}