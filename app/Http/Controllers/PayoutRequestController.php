<?php

namespace App\Http\Controllers;

use App\Models\PayoutRequest;
use App\Models\Institution;
use App\Models\SalesExecutive;

class PayoutRequestController extends Controller
{
    public function institution()
    {
        $institution = Institution::findOrFail(
            auth()->user()->institution_id
        );

        if ($institution->wallet_balance <= 0) {
            return back()->with(
                'error',
                'No funds available.'
            );
        }

        $pending = PayoutRequest::where(
            'requester_type',
            'institution'
        )
        ->where(
            'requester_id',
            $institution->id
        )
        ->where(
            'status',
            'pending'
        )
        ->exists();

        if ($pending) {
            return back()->with(
                'error',
                'You already have a pending payout request.'
            );
        }

        PayoutRequest::create([
            'requester_type' => 'institution',
            'requester_id' => $institution->id,
            'amount' => $institution->wallet_balance,
        ]);

        return back()->with(
            'success',
            'Payout request submitted.'
        );
    }

    public function sales()
    {
        $executive = SalesExecutive::where(
            'user_id',
            auth()->id()
        )->firstOrFail();

        if ($executive->wallet_balance <= 0) {
            return back()->with(
                'error',
                'No funds available.'
            );
        }

        $pending = PayoutRequest::where(
            'requester_type',
            'sales_executive'
        )
        ->where(
            'requester_id',
            $executive->id
        )
        ->where(
            'status',
            'pending'
        )
        ->exists();

        if ($pending) {
            return back()->with(
                'error',
                'You already have a pending payout request.'
            );
        }

        PayoutRequest::create([
            'requester_type' => 'sales_executive',
            'requester_id' => $executive->id,
            'amount' => $executive->wallet_balance,
        ]);

        return back()->with(
            'success',
            'Payout request submitted.'
        );
    }
}