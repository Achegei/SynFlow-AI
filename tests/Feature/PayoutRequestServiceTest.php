<?php

use App\Models\Institution;
use App\Models\PayoutRequest;
use App\Models\SalesExecutive;
use App\Models\User;
use App\Services\PayoutRequestService;

test('sales executive can request their available wallet balance', function () {
    $user = User::factory()->create();

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 3000,
        'status' => 'active',
    ]);

    $request = app(PayoutRequestService::class)
        ->create('sales_executive', $executive->id);

    expect((float) $request->amount)->toBe(3000.0)
        ->and($request->status)->toBe('pending')
        ->and((float) $executive->fresh()->wallet_balance)->toBe(3000.0);
});

test('duplicate pending payout request is rejected', function () {
    $user = User::factory()->create();

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 3000,
        'status' => 'active',
    ]);

    $service = app(PayoutRequestService::class);

    $service->create('sales_executive', $executive->id);

    expect(fn () => $service->create('sales_executive', $executive->id))
        ->toThrow(\DomainException::class);

    expect(PayoutRequest::where('requester_type', 'sales_executive')
        ->where('requester_id', $executive->id)
        ->count())->toBe(1);
});

test('empty wallet cannot request payout', function () {
    $user = User::factory()->create();

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 0,
        'status' => 'active',
    ]);

    expect(fn () => app(PayoutRequestService::class)
        ->create('sales_executive', $executive->id))
        ->toThrow(\DomainException::class);

    expect(PayoutRequest::count())->toBe(0);
});

test('institution can request its available wallet balance', function () {
    $institution = Institution::create([
        'name' => 'Payout Request Test Institution',
        'slug' => 'payout-request-test-institution',
        'referral_code' => 'PAYOUT-REQ-001',
        'wallet_balance' => 5000,
        'status' => 'active',
    ]);

    $request = app(PayoutRequestService::class)
        ->create('institution', $institution->id);

    expect((float) $request->amount)->toBe(5000.0)
        ->and($request->status)->toBe('pending')
        ->and((float) $institution->fresh()->wallet_balance)->toBe(5000.0);
});

test('invalid payout requester type is rejected', function () {
    expect(fn () => app(PayoutRequestService::class)
        ->create('unknown', 1))
        ->toThrow(\DomainException::class);

    expect(PayoutRequest::count())->toBe(0);
});
