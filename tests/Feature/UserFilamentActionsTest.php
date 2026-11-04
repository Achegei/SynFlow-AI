<?php

use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Livewire;

beforeEach(function () {
    $panel = Filament::getPanel('admin');

    Filament::setCurrentPanel($panel);
    $panel->boot();

    $this->admin = User::factory()->create([
        'is_admin' => true,
        'is_active' => true,
        'role' => 'admin',
        'must_change_password' => false,
    ]);

    $this->actingAs($this->admin);
});

test('administrator can deactivate a learner without deleting the account', function () {
    $learner = User::factory()->create([
        'is_admin' => false,
        'is_active' => true,
        'role' => 'student',
    ]);

    Livewire::test(ListUsers::class)
        ->callTableAction('deactivate', $learner)
        ->assertHasNoTableActionErrors();

    expect($learner->fresh())->not->toBeNull()
        ->and($learner->fresh()->is_active)->toBeFalse();
});

test('administrator can reactivate a learner', function () {
    $learner = User::factory()->create([
        'is_admin' => false,
        'is_active' => false,
        'role' => 'student',
    ]);

    Livewire::test(ListUsers::class)
        ->callTableAction('reactivate', $learner)
        ->assertHasNoTableActionErrors();

    expect($learner->fresh()->is_active)->toBeTrue();
});

test('administrator cannot deactivate their own account', function () {
    Livewire::test(ListUsers::class)
        ->assertTableActionHidden('deactivate', $this->admin);

    expect($this->admin->fresh()->is_active)->toBeTrue();
});

test('last active administrator cannot be deactivated', function () {
    $secondAdmin = User::factory()->create([
        'is_admin' => true,
        'is_active' => true,
        'role' => 'admin',
    ]);

    $secondAdmin->update(['is_active' => false]);

    Livewire::test(ListUsers::class)
        ->callTableAction('reactivate', $secondAdmin)
        ->assertHasNoTableActionErrors();

    $secondAdmin->refresh();

    expect($secondAdmin->is_active)->toBeTrue();

    // Deactivate the second administrator while the acting administrator remains active.
    Livewire::test(ListUsers::class)
        ->callTableAction('deactivate', $secondAdmin)
        ->assertHasNoTableActionErrors();

    expect($secondAdmin->fresh()->is_active)->toBeFalse()
        ->and($this->admin->fresh()->is_active)->toBeTrue();

    // The sole remaining administrator cannot deactivate themselves.
    Livewire::test(ListUsers::class)
        ->assertTableActionHidden('deactivate', $this->admin);

    expect($this->admin->fresh()->is_active)->toBeTrue();
});

test('deactivation refuses to disable the sole active administrator', function () {
    $soleAdmin = User::factory()->create([
        'is_admin' => true,
        'is_active' => true,
        'role' => 'admin',
    ]);

    // Simulate an authenticated session whose account has since been disabled.
    // The target is now the only active administrator.
    $this->admin->update(['is_active' => false]);

    Livewire::test(ListUsers::class)
        ->callTableAction('deactivate', $soleAdmin)
        ->assertHasNoTableActionErrors();

    expect($soleAdmin->fresh()->is_active)->toBeTrue();
});

test('administrator can deactivate another administrator when one remains active', function () {
    $otherAdmin = User::factory()->create([
        'is_admin' => true,
        'is_active' => true,
        'role' => 'admin',
    ]);

    Livewire::test(ListUsers::class)
        ->callTableAction('deactivate', $otherAdmin)
        ->assertHasNoTableActionErrors();

    expect($otherAdmin->fresh()->is_active)->toBeFalse()
        ->and($this->admin->fresh()->is_active)->toBeTrue();
});
