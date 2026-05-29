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

        // Find institution linked to this user
        $institution = Institution::where('id', $user->institution_id ?? null)
            ->with(['salesExecutive'])
            ->first();

        // Students belonging to this institution
        $students = User::where('institution_id', $institution?->id)
            ->where('role', 'student')
            ->get();

        // Payments from those students
        $payments = Payment::whereIn('user_id', $students->pluck('id'))
            ->where('status', 'success')
            ->get();

        // Revenue calculations
        $totalRevenue = $payments->sum('amount');
        $institutionShare = $totalRevenue * 0.40;

        return view('dashboards.institution', [
            'institution' => $institution,
            'students' => $students,
            'totalRevenue' => $totalRevenue,
            'institutionShare' => $institutionShare,
        ]);
    }
}