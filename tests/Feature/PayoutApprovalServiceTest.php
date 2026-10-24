<?php

use App\Models\PayoutRequest;
use App\Models\SalesExecutive;
use App\Models\User;
use App\Services\PayoutApprovalService;

test('approving a sales payout deducts the wallet exactly once', function () {
    $user = User::factory()->create();

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 3000,
        'commission_percentage' => 10,
        'status' => 'active',
    ]);

    $request = PayoutRequest::create([
        'requester_type' => 'sales_executive',
        'requester_id' => $executive->id,
        'amount' => 1000,
        'status' => 'pending',
    ]);

    $admin = User::factory()->create([
        'is_admin' => true,
        'role' => 'admin',
    ]);

    $service = app(PayoutApprovalService::class);

    $service->approve($request, $admin->id);
    $service->approve($request, $admin->id);

    expect((float) $executive->fresh()->wallet_balance)->toBe(2000.0)
        ->and($request->fresh()->status)->toBe('approved')
        ->and($request->fresh()->approved_by)->toBe($admin->id);
});

test('insufficient wallet funds cannot be approved', function () {
    $user = User::factory()->create();

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 500,
        'commission_percentage' => 10,
        'status' => 'active',
    ]);

    $request = PayoutRequest::create([
        'requester_type' => 'sales_executive',
        'requester_id' => $executive->id,
        'amount' => 1000,
        'status' => 'pending',
    ]);

    $admin = User::factory()->create([
        'is_admin' => true,
        'role' => 'admin',
    ]);

    expect(fn () => app(PayoutApprovalService::class)
        ->approve($request, $admin->id))
        ->toThrow(\DomainException::class);

    expect((float) $executive->fresh()->wallet_balance)->toBe(500.0)
        ->and($request->fresh()->status)->toBe('pending');
});


test('approving an institution payout deducts the wallet exactly once', function () {
    $institution = \App\Models\Institution::create([
        'name' => 'Payout Regression Test School',
        'slug' => 'payout-regression-test-school',
        'referral_code' => 'PAYOUT-TEST-001',
        'wallet_balance' => 5000,
        'status' => 'active',
    ]);

    $request = PayoutRequest::create([
        'requester_type' => 'institution',
        'requester_id' => $institution->id,
        'amount' => 2200,
        'status' => 'pending',
    ]);

    $admin = User::factory()->create();

    $service = app(PayoutApprovalService::class);

    $service->approve($request, $admin->id);
    $service->approve($request, $admin->id);

    expect((float) $institution->fresh()->wallet_balance)->toBe(2800.0)
        ->and($request->fresh()->status)->toBe('approved');
});

test('rejected payout cannot be approved', function () {
    $user = User::factory()->create();

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 2000,
        'status' => 'active',
    ]);

    $request = PayoutRequest::create([
        'requester_type' => 'sales_executive',
        'requester_id' => $executive->id,
        'amount' => 1000,
        'status' => 'rejected',
    ]);

    $admin = User::factory()->create();

    expect(fn () => app(PayoutApprovalService::class)
        ->approve($request, $admin->id))
        ->toThrow(\DomainException::class);

    expect((float) $executive->fresh()->wallet_balance)->toBe(2000.0)
        ->and($request->fresh()->status)->toBe('rejected');
});

test('missing payout requester cannot be approved', function () {
    $request = PayoutRequest::create([
        'requester_type' => 'sales_executive',
        'requester_id' => 999999999,
        'amount' => 1000,
        'status' => 'pending',
    ]);

    $admin = User::factory()->create();

    expect(fn () => app(PayoutApprovalService::class)
        ->approve($request, $admin->id))
        ->toThrow(\DomainException::class);

    expect($request->fresh()->status)->toBe('pending');
});

test('zero-value payout cannot be approved', function () {
    $user = User::factory()->create();

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 2000,
        'status' => 'active',
    ]);

    $request = PayoutRequest::create([
        'requester_type' => 'sales_executive',
        'requester_id' => $executive->id,
        'amount' => 0,
        'status' => 'pending',
    ]);

    $admin = User::factory()->create();

    expect(fn () => app(PayoutApprovalService::class)
        ->approve($request, $admin->id))
        ->toThrow(\DomainException::class);

    expect((float) $executive->fresh()->wallet_balance)->toBe(2000.0)
        ->and($request->fresh()->status)->toBe('pending');
});

test('repeated approval preserves the original approval audit fields', function () {
    $user = User::factory()->create();

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 2000,
        'status' => 'active',
    ]);

    $request = PayoutRequest::create([
        'requester_type' => 'sales_executive',
        'requester_id' => $executive->id,
        'amount' => 1000,
        'status' => 'pending',
    ]);

    $firstAdmin = User::factory()->create();
    $secondAdmin = User::factory()->create();

    $service = app(PayoutApprovalService::class);

    $service->approve($request, $firstAdmin->id);

    $processedAt = $request->fresh()->processed_at;

    $service->approve($request, $secondAdmin->id);

    expect($request->fresh()->approved_by)->toBe($firstAdmin->id)
        ->and($request->fresh()->processed_at)->toBe($processedAt)
        ->and((float) $executive->fresh()->wallet_balance)->toBe(1000.0);
});


test('rejecting a pending payout preserves the wallet balance', function () {
    $user = User::factory()->create();

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 3000,
        'status' => 'active',
    ]);

    $request = PayoutRequest::create([
        'requester_type' => 'sales_executive',
        'requester_id' => $executive->id,
        'amount' => 1000,
        'status' => 'pending',
    ]);

    app(PayoutApprovalService::class)->reject($request);

    expect($request->fresh()->status)->toBe('rejected')
        ->and((float) $executive->fresh()->wallet_balance)->toBe(3000.0)
        ->and($request->fresh()->approved_by)->toBeNull()
        ->and($request->fresh()->processed_at)->toBeNull();
});

test('rejecting the same payout twice is idempotent', function () {
    $user = User::factory()->create();

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 3000,
        'status' => 'active',
    ]);

    $request = PayoutRequest::create([
        'requester_type' => 'sales_executive',
        'requester_id' => $executive->id,
        'amount' => 1000,
        'status' => 'pending',
    ]);

    $service = app(PayoutApprovalService::class);

    $service->reject($request);

    $updatedAt = $request->fresh()->updated_at;

    $service->reject($request);

    expect($request->fresh()->status)->toBe('rejected')
        ->and($request->fresh()->updated_at->equalTo($updatedAt))->toBeTrue()
        ->and((float) $executive->fresh()->wallet_balance)->toBe(3000.0);
});

test('approved payout cannot subsequently be rejected', function () {
    $user = User::factory()->create();

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 3000,
        'status' => 'active',
    ]);

    $request = PayoutRequest::create([
        'requester_type' => 'sales_executive',
        'requester_id' => $executive->id,
        'amount' => 1000,
        'status' => 'pending',
    ]);

    $admin = User::factory()->create();

    $service = app(PayoutApprovalService::class);

    $service->approve($request, $admin->id);

    expect(fn () => $service->reject($request))
        ->toThrow(\DomainException::class);

    expect($request->fresh()->status)->toBe('approved')
        ->and((float) $executive->fresh()->wallet_balance)->toBe(2000.0)
        ->and($request->fresh()->approved_by)->toBe($admin->id);
});

test('institution payout rejection does not deduct institution funds', function () {
    $institution = \App\Models\Institution::create([
        'name' => 'Rejected Payout Test Institution',
        'slug' => 'rejected-payout-test-institution',
        'referral_code' => 'REJECT-PAYOUT-001',
        'wallet_balance' => 5000,
        'status' => 'active',
    ]);

    $request = PayoutRequest::create([
        'requester_type' => 'institution',
        'requester_id' => $institution->id,
        'amount' => 2200,
        'status' => 'pending',
    ]);

    app(PayoutApprovalService::class)->reject($request);

    expect($request->fresh()->status)->toBe('rejected')
        ->and((float) $institution->fresh()->wallet_balance)->toBe(5000.0);
});
