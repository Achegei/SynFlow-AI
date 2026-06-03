<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesExecutive;

class SalesDashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();

    $executive = \App\Models\SalesExecutive::where('user_id', $user->id)->first();

    if (!$executive) {
        abort(403, 'Sales executive profile not found');
    }

    /*
    |--------------------------------------------------------------------------
    | PAGINATED INSTITUTIONS (10 PER PAGE)
    |--------------------------------------------------------------------------
    */

    $institutions = \App\Models\Institution::where('sales_executive_id', $executive->id)
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    /*
    |--------------------------------------------------------------------------
    | WALLET + COMMISSION
    |--------------------------------------------------------------------------
    */

    $walletBalance = $executive->wallet_balance ?? 0;
    $commission = $executive->commission_percentage ?? 0;

    return view('dashboards.sales', [
        'executive' => $executive,
        'institutions' => $institutions,
        'walletBalance' => $walletBalance,
        'commission' => $commission,
    ]);
}
}