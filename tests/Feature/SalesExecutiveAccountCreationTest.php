<?php

use App\Filament\Resources\SalesExecutiveResource\Pages\CreateSalesExecutive;
use App\Models\SalesExecutive;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

beforeEach(function () {
    $panel = Filament::getPanel('admin');
    Filament::setCurrentPanel($panel);
    $panel->boot();

    $this->actingAs(User::factory()->create([
        'is_admin' => true,
        'role' => 'admin',
        'must_change_password' => false,
    ]));
});

test('administrator creates a new salesperson and login account together', function () {
    Livewire::test(CreateSalesExecutive::class)
        ->fillForm([
            'account_mode' => 'new',
            'new_user_name' => 'Test Sales Executive',
            'new_user_email' => 'sales-onboarding@example.com',
            'new_user_password' => 'SecurePassword123!',
            'new_user_password_confirmation' => 'SecurePassword123!',
            'status' => 'active',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $user = User::where('email', 'sales-onboarding@example.com')->first();

    expect($user)->not->toBeNull()
        ->and($user->role)->toBe('sales_executive')
        ->and((bool) $user->is_admin)->toBeFalse()
        ->and((bool) $user->must_change_password)->toBeTrue()
        ->and($user->username)->not->toBeEmpty()
        ->and(Hash::check('SecurePassword123!', $user->password))->toBeTrue();

    $executive = SalesExecutive::where('user_id', $user->id)->first();

    expect($executive)->not->toBeNull()
        ->and($executive->status)->toBe('active')
        ->and((float) $executive->wallet_balance)->toBe(0.0);
});

test('administrator cannot create a salesperson using an existing email', function () {
    User::factory()->create([
        'email' => 'already-registered@example.com',
    ]);

    Livewire::test(CreateSalesExecutive::class)
        ->fillForm([
            'account_mode' => 'new',
            'new_user_name' => 'Duplicate Account',
            'new_user_email' => 'already-registered@example.com',
            'new_user_password' => 'SecurePassword123!',
            'new_user_password_confirmation' => 'SecurePassword123!',
            'status' => 'active',
        ])
        ->call('create')
        ->assertHasFormErrors(['new_user_email']);

    expect(
        SalesExecutive::whereHas('user', fn ($query) =>
            $query->where('email', 'already-registered@example.com')
        )->exists()
    )->toBeFalse();
});

test('administrator cannot link an existing administrator as a salesperson', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'is_admin' => true,
    ]);

    Livewire::test(CreateSalesExecutive::class)
        ->fillForm([
            'account_mode' => 'existing',
            'user_id' => $admin->id,
            'status' => 'active',
        ])
        ->call('create')
        ->assertHasFormErrors(['user_id']);

    expect(SalesExecutive::where('user_id', $admin->id)->exists())->toBeFalse()
        ->and($admin->fresh()->role)->toBe('admin');
});

test('administrator cannot link the same salesperson twice', function () {
    $user = User::factory()->create([
        'role' => 'sales_executive',
    ]);

    SalesExecutive::create([
        'user_id' => $user->id,
        'status' => 'active',
    ]);

    Livewire::test(CreateSalesExecutive::class)
        ->fillForm([
            'account_mode' => 'existing',
            'user_id' => $user->id,
            'status' => 'active',
        ])
        ->call('create')
        ->assertHasFormErrors(['user_id']);

    expect(
        SalesExecutive::where('user_id', $user->id)->count()
    )->toBe(1);
});


test('administrator preserves an existing user password when linking', function () {
    $user = User::factory()->create([
        'role' => 'client',
        'is_admin' => false,
        'institution_id' => null,
        'password' => 'OriginalPassword123!',
    ]);

    $originalPasswordHash = $user->password;

    Livewire::test(CreateSalesExecutive::class)
        ->fillForm([
            'account_mode' => 'existing',
            'user_id' => $user->id,
            'status' => 'active',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect($user->fresh()->password)->toBe($originalPasswordHash)
        ->and($user->fresh()->role)->toBe('sales_executive')
        ->and(SalesExecutive::where('user_id', $user->id)->count())->toBe(1);
});

test('administrator cannot convert an institution administrator', function () {
    $user = User::factory()->create([
        'role' => 'institution_admin',
        'is_admin' => false,
    ]);

    Livewire::test(CreateSalesExecutive::class)
        ->fillForm([
            'account_mode' => 'existing',
            'user_id' => $user->id,
            'status' => 'active',
        ])
        ->call('create')
        ->assertHasFormErrors(['user_id']);

    expect($user->fresh()->role)->toBe('institution_admin')
        ->and(SalesExecutive::where('user_id', $user->id)->exists())->toBeFalse();
});

test('administrator cannot convert an institution-linked user', function () {
    $user = User::factory()->create([
        'role' => 'student',
        'is_admin' => false,
    ]);

    $institution = \App\Models\Institution::create([
        'name' => 'Sales Account Protection Test College',
        'slug' => 'sales-account-protection-test-college',
        'referral_code' => 'SALES-PROTECT-001',
        'status' => 'active',
        'wallet_balance' => 0,
    ]);

    $user->institution_id = $institution->id;
    $user->saveQuietly();

    Livewire::test(CreateSalesExecutive::class)
        ->fillForm([
            'account_mode' => 'existing',
            'user_id' => $user->id,
            'status' => 'active',
        ])
        ->call('create')
        ->assertHasFormErrors(['user_id']);

    expect($user->fresh()->role)->toBe('student')
        ->and(SalesExecutive::where('user_id', $user->id)->exists())->toBeFalse();
});


test('database rejects duplicate salesperson assignments', function () {
    $user = User::factory()->create([
        'role' => 'sales_executive',
    ]);

    SalesExecutive::create([
        'user_id' => $user->id,
        'status' => 'active',
    ]);

    expect(fn () => SalesExecutive::create([
        'user_id' => $user->id,
        'status' => 'active',
    ]))->toThrow(\Illuminate\Database\QueryException::class);

    expect(SalesExecutive::where('user_id', $user->id)->count())->toBe(1);
});

test('failed salesperson creation rolls back the new user account', function () {
    $email = 'rollback-salesperson@example.com';

    \Illuminate\Support\Facades\DB::statement(
        "CREATE TRIGGER reject_sales_executive_creation
         BEFORE INSERT ON sales_executives
         BEGIN
             SELECT RAISE(ABORT, 'Simulated salesperson creation failure');
         END"
    );

    try {
        Livewire::test(CreateSalesExecutive::class)
            ->fillForm([
                'account_mode' => 'new',
                'new_user_name' => 'Rollback Test Executive',
                'new_user_email' => $email,
                'new_user_password' => 'SecurePassword123!',
                'new_user_password_confirmation' => 'SecurePassword123!',
                'status' => 'active',
            ])
            ->call('create');
    } catch (\Illuminate\Database\QueryException $exception) {
        // Expected simulated database failure.
    } finally {
        \Illuminate\Support\Facades\DB::statement(
            'DROP TRIGGER IF EXISTS reject_sales_executive_creation'
        );
    }

    expect(User::where('email', $email)->exists())->toBeFalse();
});
