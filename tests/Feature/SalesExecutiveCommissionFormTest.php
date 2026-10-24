<?php

use App\Filament\Resources\SalesExecutiveResource;
use App\Filament\Resources\SalesExecutiveResource\Pages\CreateSalesExecutive;
use App\Filament\Resources\SalesExecutiveResource\Pages\EditSalesExecutive;
use App\Models\SalesExecutive;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Livewire\Livewire;

beforeEach(function () {
    $panel = Filament::getPanel('admin');

    Filament::setCurrentPanel($panel);
    $panel->boot();

    $admin = User::factory()->create([
        'is_admin' => true,
        'role' => 'admin',
        'must_change_password' => false,
    ]);

    $this->actingAs($admin);
});

test('commission is informational rather than an editable percentage', function () {
    $component = Livewire::test(CreateSalesExecutive::class);

    $components = $component->instance()
        ->form
        ->getFlatComponents();

    $namedComponents = collect($components)
        ->filter(fn ($component) => method_exists($component, 'getName'))
        ->keyBy(fn ($component) => $component->getName());

    expect($namedComponents->has('enrollment_commission'))->toBeTrue()
        ->and($namedComponents->has('commission_percentage'))->toBeFalse();

    $placeholder = $namedComponents->get('enrollment_commission');

    expect($placeholder)->toBeInstanceOf(Placeholder::class)
        ->and((string) $placeholder->getContent())
        ->toContain('KES 1,000.00');
});

test('administrator can create an executive without supplying a percentage', function () {
    $user = User::factory()->create();

    Livewire::test(CreateSalesExecutive::class)
        ->fillForm([
            'account_mode' => 'existing',
            'user_id' => $user->id,
            'status' => 'active',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $executive = SalesExecutive::query()
        ->where('user_id', $user->id)
        ->first();

    expect($executive)->not->toBeNull()
        ->and((float) $executive->commission_percentage)->toBe(10.0)
        ->and((float) $executive->wallet_balance)->toBe(0.0);
});

test('editing an executive preserves the historical commission percentage', function () {
    $user = User::factory()->create();

    $executive = SalesExecutive::create([
        'user_id' => $user->id,
        'commission_percentage' => 17.5,
        'wallet_balance' => 2500,
        'status' => 'active',
    ]);

    Livewire::test(EditSalesExecutive::class, [
        'record' => $executive->getRouteKey(),
    ])
        ->fillForm([
            'status' => 'inactive',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($executive->fresh()->status)->toBe('inactive')
        ->and((float) $executive->fresh()->commission_percentage)->toBe(17.5)
        ->and((float) $executive->fresh()->wallet_balance)->toBe(2500.0);
});
