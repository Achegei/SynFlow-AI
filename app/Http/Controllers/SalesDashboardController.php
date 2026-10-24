<?php

namespace App\Http\Controllers;

use App\Models\CommissionTransaction;
use App\Models\CourseEnrollment;
use App\Models\Institution;
use App\Models\SalesExecutive;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SalesDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $executive = SalesExecutive::where('user_id', $user->id)
            ->firstOrFail();

        $institutionIds = Institution::where(
            'sales_executive_id',
            $executive->id
        )->pluck('id');

        $institutions = Institution::whereIn('id', $institutionIds)
            ->orderByDesc('created_at')
            ->paginate(10);

        /*
        |--------------------------------------------------------------------------
        | Unique Students — Historical + New Enrollment System
        |--------------------------------------------------------------------------
        */

        $studentIds = User::query()
            ->where('role', 'student')
            ->where(function ($query) use ($institutionIds) {
                $query->whereIn('institution_id', $institutionIds)
                    ->orWhereIn('id', CourseEnrollment::query()
                        ->select('user_id')
                        ->whereIn('institution_id', $institutionIds)
                        ->where('registration_context', 'institution'));
            })
            ->select('id');

        $totalStudents = DB::query()
            ->fromSub($studentIds, 'students')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Registration Activity
        |--------------------------------------------------------------------------
        */

        $registrationBase = User::query()
            ->where('role', 'student')
            ->where(function ($query) use ($institutionIds) {
                $query->whereIn('institution_id', $institutionIds)
                    ->orWhereIn('id', CourseEnrollment::query()
                        ->select('user_id')
                        ->whereIn('institution_id', $institutionIds)
                        ->where('registration_context', 'institution'));
            });

        $newToday = (clone $registrationBase)
            ->whereDate('created_at', today())
            ->count();

        $newYesterday = (clone $registrationBase)
            ->whereDate('created_at', today()->subDay())
            ->count();

        $newLast7Days = (clone $registrationBase)
            ->where('created_at', '>=', today()->subDays(6))
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Paid Enrollments — Only Those Attributed to This Executive
        |--------------------------------------------------------------------------
        */

        $paidEnrollments = CourseEnrollment::query()
            ->where('sales_executive_id', $executive->id)
            ->whereIn('institution_id', $institutionIds)
            ->where('registration_context', 'institution')
            ->where('status', 'paid')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Actual Commission Ledger
        |--------------------------------------------------------------------------
        */

        $totalCommissionEarned = CommissionTransaction::query()
            ->where('sales_executive_id', $executive->id)
            ->sum('sales_amount');

        $commissionPerEnrollment = (float) config(
            'enrollment.sales_commission',
            1000
        );

        /*
        |--------------------------------------------------------------------------
        | 30-Day Registration Trend
        |--------------------------------------------------------------------------
        */

        $registrationTrend = [];

        for ($daysAgo = 29; $daysAgo >= 0; $daysAgo--) {
            $date = today()->subDays($daysAgo);

            $registrationTrend[] = [
                'date' => $date->format('M j'),
                'count' => (clone $registrationBase)
                    ->whereDate('created_at', $date)
                    ->count(),
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Institution Performance
        |--------------------------------------------------------------------------
        */

        $institutionPerformance = $institutions->getCollection()
            ->map(function ($institution) use ($executive) {
                $studentCount = User::query()
                    ->where('role', 'student')
                    ->where(function ($query) use ($institution) {
                        $query->where('institution_id', $institution->id)
                            ->orWhereIn('id', CourseEnrollment::query()
                                ->select('user_id')
                                ->where('institution_id', $institution->id)
                                ->where('registration_context', 'institution'));
                    })
                    ->count();

                $paidCount = CourseEnrollment::query()
                    ->where('institution_id', $institution->id)
                    ->where('sales_executive_id', $executive->id)
                    ->where('status', 'paid')
                    ->where('registration_context', 'institution')
                    ->count();

                return [
                    'institution' => $institution,
                    'students' => $studentCount,
                    'paid_enrollments' => $paidCount,
                ];
            });

        return view('dashboards.sales', [
            'executive' => $executive,
            'institutions' => $institutions,
            'institutionPerformance' => $institutionPerformance,
            'walletBalance' => $executive->wallet_balance ?? 0,
            'totalInstitutions' => $institutionIds->count(),
            'totalStudents' => $totalStudents,
            'newToday' => $newToday,
            'newYesterday' => $newYesterday,
            'newLast7Days' => $newLast7Days,
            'paidEnrollments' => $paidEnrollments,
            'commissionPerEnrollment' => $commissionPerEnrollment,
            'totalCommissionEarned' => $totalCommissionEarned,
            'registrationTrend' => $registrationTrend,
        ]);
    }
}
