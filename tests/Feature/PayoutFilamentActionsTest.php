<?php

use App\Filament\Resources\PayoutRequestResource\Pages\ListPayoutRequests;
use App\Models\PayoutRequest;
use App\Models\SalesExecutive;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Livewire;

beforeEach(function () {
    $panel = Filament::getPanel('admin');

    Filament::setCurrentPanel($panel);
    $panel->boot();

    $this->admin = User::factory()->create([
        'is_admin' => true,
        'role' => 'admin',
        'must_change_password' => false,
    ]);

    $this->actingAs($this->admin);
});

test('Filament approval deducts the wallet and records the administrator', function () {
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

    Livewire::test(ListPayoutRequests::class)
        ->callTableAction('approve', $request)
        ->assertHasNoTableActionErrors();

    expect($request->fresh()->status)->toBe('approved')
        ->and((float) $executive->fresh()->wallet_balance)->toBe(2000.0)
        ->and($request->fresh()->approved_by)->toBe($this->admin->id)
        ->and($request->fresh()->processed_at)->not->toBeNull();
});

test('Filament rejection preserves the wallet balance', function () {
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

    Livewire::test(ListPayoutRequests::class)
        ->callTableAction('reject', $request)
        ->assertHasNoTableActionErrors();

    expect($request->fresh()->status)->toBe('rejected')
        ->and((float) $executive->fresh()->wallet_balance)->toBe(3000.0);
});
