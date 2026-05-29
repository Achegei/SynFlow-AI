<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesExecutive;

class SalesDashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();

    $executive = \App\Models\SalesExecutive::with('institutions')
        ->where('user_id', $user->id)
        ->first();

    // REAL institution list (not just count)
    $institutions = $executive?->institutions ?? collect();

    // Wallet (placeholder until payment engine)
    $walletBalance = $executive?->wallet_balance ?? 0;

    $commission = $executive?->commission_percentage ?? 0;

    return view('dashboards.sales', [
        'executive' => $executive,
        'institutions' => $institutions,
        'walletBalance' => $walletBalance,
        'commission' => $commission,
    ]);
}
}