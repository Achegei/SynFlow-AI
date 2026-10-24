<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\SalesExecutive;
use App\Services\PayoutRequestService;
use DomainException;

class PayoutRequestController extends Controller
{
    public function institution()
    {
        $institution = Institution::findOrFail(
            auth()->user()->institution_id
        );

        try {
            app(PayoutRequestService::class)
                ->create('institution', $institution->id);
        } catch (DomainException $exception) {
            return back()->with('error', $exception->getMessage());
        }

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

        try {
            app(PayoutRequestService::class)
                ->create('sales_executive', $executive->id);
        } catch (DomainException $exception) {
            return back()->with('error', $exception->getMessage());
        }

        return back()->with(
            'success',
            'Payout request submitted.'
        );
    }
}
