<?php

namespace App\Http\Controllers;

use App\Models\CommissionTransaction;
use App\Models\CourseEnrollment;
use App\Models\Institution;
use App\Models\User;

class InstitutionDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (! $user) {
            abort(403, 'Unauthorized');
        }

        $institution = Institution::with('salesExecutive')
            ->find($user->institution_id);

        if (! $institution) {
            abort(403, 'No institution linked to this account');
        }

        /*
        |--------------------------------------------------------------------------
        | Historical + New Students (Deduplicated)
        |--------------------------------------------------------------------------
        */

        $studentQuery = User::query()
            ->where('role', 'student')
            ->where(function ($query) use ($institution) {
                $query->where('institution_id', $institution->id)
                    ->orWhereIn(
                        'id',
                        CourseEnrollment::query()
                            ->select('user_id')
                            ->where('institution_id', $institution->id)
                            ->where('registration_context', 'institution')
                    );
            });

        $totalStudents = (clone $studentQuery)->count();

        $students = (clone $studentQuery)
            ->latest()
            ->paginate(10);

        /*
        |--------------------------------------------------------------------------
        | Student Registration Activity
        |--------------------------------------------------------------------------
        */

        $newToday = (clone $studentQuery)
            ->whereDate('created_at', today())
            ->count();

        $newYesterday = (clone $studentQuery)
            ->whereDate('created_at', today()->subDay())
            ->count();

        $newLast7Days = (clone $studentQuery)
            ->where('created_at', '>=', today()->subDays(6))
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Confirmed Course Enrollments
        |--------------------------------------------------------------------------
        */

        $paidEnrollments = CourseEnrollment::query()
            ->where('institution_id', $institution->id)
            ->where('registration_context', 'institution')
            ->where('status', 'paid')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Financial Metrics — Recorded Transactions
        |--------------------------------------------------------------------------
        */

        $ledger = CommissionTransaction::query()
            ->where('institution_id', $institution->id);

        $totalRevenue = (clone $ledger)->sum('total_amount');

        $institutionShare = (clone $ledger)->sum('institution_amount');

        $platformShare = (clone $ledger)->sum('company_amount');

        $walletBalance = $institution->wallet_balance ?? 0;

        $institutionPercentage = (float) config(
            'enrollment.institution_percentage',
            40
        );

        /*
        |--------------------------------------------------------------------------
        | Learning Activity
        |--------------------------------------------------------------------------
        */

        $activeToday = (clone $studentQuery)
            ->whereDate('last_activity_at', today())
            ->count();

        $activeThisWeek = (clone $studentQuery)
            ->where('last_activity_at', '>=', now()->subDays(7))
            ->count();

        $inactiveStudents = (clone $studentQuery)
            ->where(function ($query) {
                $query->whereNull('last_activity_at')
                    ->orWhere('last_activity_at', '<', now()->subDays(14));
            })
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Registration Trend — Last 30 Days
        |--------------------------------------------------------------------------
        */

        $registrationTrend = [];

        for ($daysAgo = 29; $daysAgo >= 0; $daysAgo--) {
            $date = today()->subDays($daysAgo);

            $registrationTrend[] = [
                'date' => $date->format('M j'),
                'count' => (clone $studentQuery)
                    ->whereDate('created_at', $date)
                    ->count(),
            ];
        }

        return view('dashboards.institution', [
            'institution' => $institution,
            'students' => $students,
            'totalStudents' => $totalStudents,
            'newToday' => $newToday,
            'newYesterday' => $newYesterday,
            'newLast7Days' => $newLast7Days,
            'paidEnrollments' => $paidEnrollments,
            'totalRevenue' => $totalRevenue,
            'institutionShare' => $institutionShare,
            'platformShare' => $platformShare,
            'walletBalance' => $walletBalance,
            'institutionPercentage' => $institutionPercentage,
            'activeToday' => $activeToday,
            'activeThisWeek' => $activeThisWeek,
            'inactiveStudents' => $inactiveStudents,
            'registrationTrend' => $registrationTrend,
        ]);
    }
}
