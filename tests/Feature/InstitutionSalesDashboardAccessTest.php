<?php

use App\Models\User;

test('guests cannot access institution or sales dashboards', function () {
    $this->get(route('institution.dashboard'))
        ->assertRedirect(route('login'));

    $this->get(route('sales.dashboard'))
        ->assertRedirect(route('login'));
});

test('guests cannot submit institution or sales payout requests', function () {
    $this->post(route('institution.request-payout'))
        ->assertRedirect(route('login'));

    $this->post(route('sales.request-payout'))
        ->assertRedirect(route('login'));
});

test('institution admins cannot access the sales dashboard', function () {
    $user = User::factory()->create([
        'role' => 'institution_admin',
        'must_change_password' => false,
    ]);

    $this->actingAs($user)
        ->get(route('sales.dashboard'))
        ->assertRedirect(route('login'));
});

test('sales executives cannot access the institution dashboard', function () {
    $user = User::factory()->create([
        'role' => 'sales_executive',
        'must_change_password' => false,
    ]);

    $this->actingAs($user)
        ->get(route('institution.dashboard'))
        ->assertRedirect(route('login'));
});

test('institution admin can view their linked institution dashboard', function () {
    $institution = \App\Models\Institution::create([
        'name' => 'Dashboard Test Institution',
        'slug' => 'dashboard-test-institution',
        'referral_code' => 'TEST-INST-001',
        'status' => 'active',
        'wallet_balance' => 0,
    ]);

    $admin = User::factory()->create([
        'role' => 'institution_admin',
        'institution_id' => $institution->id,
        'must_change_password' => false,
    ]);

    $this->actingAs($admin)
        ->get(route('institution.dashboard'))
        ->assertOk()
        ->assertSee('Dashboard Test Institution');
});

test('sales executive can view their own sales dashboard', function () {
    $user = User::factory()->create([
        'role' => 'sales_executive',
        'must_change_password' => false,
    ]);

    \App\Models\SalesExecutive::create([
        'user_id' => $user->id,
        'wallet_balance' => 0,
        'commission_percentage' => 10,
        'status' => 'active',
    ]);

    $this->actingAs($user)
        ->get(route('sales.dashboard'))
        ->assertOk()
        ->assertSee('Sales Executive Dashboard');
});
