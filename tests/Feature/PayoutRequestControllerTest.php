<?php

use App\Models\Institution;
use App\Models\PayoutRequest;
use App\Models\SalesExecutive;
use App\Models\User;

test('institution admin can submit a payout request through the HTTP endpoint', function () {
    $institution = Institution::create([
        'name' => 'HTTP Payout Test Institution',
        'slug' => 'http-payout-test-institution',
        'referral_code' => 'HTTP-PAYOUT-001',
        'wallet_balance' => 5000,
        'status' => 'active',
    ]);

    $admin = User::factory()->create([
        'role' => 'institution_admin',
        'institution_id' => $institution->id,
        'must_change_password' => false,
    ]);

    $this->actingAs($admin)
        ->from(route('institution.dashboard'))
        ->post(route('institution.request-payout'))
        ->assertRedirect(route('institution.dashboard'))
        ->assertSessionHas('success', 'Payout request submitted.');

    $request = PayoutRequest::where('requester_type', 'institution')
        ->where('requester_id', $institution->id)
        ->firstOrFail();

    expect((float) $request->amount)->toBe(5000.0)
        ->and($request->status)->toBe('pending')
        ->and((float) $institution->fresh()->wallet_balance)->toBe(5000.0);
});

test('sales executive can submit a payout request through the HTTP endpoint', function () {
    $user = User::factory()->create([
        'role' => 'sales_executive',
        'must_change_password' => false,
    ]);

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 3000,
        'status' => 'active',
    ]);

    $this->actingAs($user)
        ->from(route('sales.dashboard'))
        ->post(route('sales.request-payout'))
        ->assertRedirect(route('sales.dashboard'))
        ->assertSessionHas('success', 'Payout request submitted.');

    $request = PayoutRequest::where('requester_type', 'sales_executive')
        ->where('requester_id', $executive->id)
        ->firstOrFail();

    expect((float) $request->amount)->toBe(3000.0)
        ->and($request->status)->toBe('pending');
});

test('duplicate sales payout request returns an error without creating another request', function () {
    $user = User::factory()->create([
        'role' => 'sales_executive',
        'must_change_password' => false,
    ]);

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 3000,
        'status' => 'active',
    ]);

    $this->actingAs($user)
        ->from(route('sales.dashboard'))
        ->post(route('sales.request-payout'))
        ->assertSessionHas('success');

    $this->actingAs($user)
        ->from(route('sales.dashboard'))
        ->post(route('sales.request-payout'))
        ->assertRedirect(route('sales.dashboard'))
        ->assertSessionHas(
            'error',
            'You already have a pending payout request.'
        );

    expect(PayoutRequest::where('requester_type', 'sales_executive')
        ->where('requester_id', $executive->id)
        ->count())->toBe(1);
});

test('sales executive with an empty wallet receives an error', function () {
    $user = User::factory()->create([
        'role' => 'sales_executive',
        'must_change_password' => false,
    ]);

    SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 0,
        'status' => 'active',
    ]);

    $this->actingAs($user)
        ->from(route('sales.dashboard'))
        ->post(route('sales.request-payout'))
        ->assertRedirect(route('sales.dashboard'))
        ->assertSessionHas('error', 'No funds available.');

    expect(PayoutRequest::count())->toBe(0);
});
