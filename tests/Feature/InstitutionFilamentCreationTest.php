<?php

use App\Filament\Resources\InstitutionResource\Pages\CreateInstitution;
use App\Models\Institution;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Livewire;

beforeEach(function () {
    $panel = Filament::getPanel('admin');

    Filament::setCurrentPanel($panel);
    $panel->boot();

    $admin = User::factory()->create([
        'is_admin' => true,
        'role' => 'admin',
    ]);

    $this->actingAs($admin);
});

function institutionCreationData(array $overrides = []): array
{
    return array_merge([
        'name' => 'Regression Test College',
        'slug' => 'regression-test-college',
        'referral_code' => null,
        'admin_name' => 'College Administrator',
        'admin_email' => 'college-admin@example.test',
        'admin_password' => 'SecurePassword123!',
        'contact_person' => 'College Contact',
        'email' => 'college@example.test',
        'phone' => '0712345678',
        'sales_executive_id' => null,
        'status' => 'active',
    ], $overrides);
}

test('institution can be created without a referral code', function () {
    Livewire::test(CreateInstitution::class)
        ->fillForm(institutionCreationData())
        ->call('create')
        ->assertHasNoFormErrors();

    $institution = Institution::where(
        'slug',
        'regression-test-college'
    )->firstOrFail();

    expect($institution->referral_code)->toBeNull();

    $administrator = User::where(
        'email',
        'college-admin@example.test'
    )->firstOrFail();

    expect($administrator->role)->toBe('institution_admin')
        ->and($administrator->institution_id)->toBe($institution->id)
        ->and($institution->institution_admin_id)->toBe($administrator->id)
        ->and((bool) $administrator->must_change_password)->toBeTrue();
});

test('duplicate institution referral codes are rejected', function () {
    Livewire::test(CreateInstitution::class)
        ->fillForm(institutionCreationData([
            'referral_code' => 'COLLEGE-REF-001',
        ]))
        ->call('create')
        ->assertHasNoFormErrors();

    Livewire::test(CreateInstitution::class)
        ->fillForm(institutionCreationData([
            'name' => 'Second College',
            'slug' => 'second-college',
            'admin_email' => 'second-admin@example.test',
            'email' => 'second-college@example.test',
            'referral_code' => 'COLLEGE-REF-001',
        ]))
        ->call('create')
        ->assertHasFormErrors(['referral_code' => 'unique']);

    expect(
        Institution::where('referral_code', 'COLLEGE-REF-001')->count()
    )->toBe(1);
});

test('failed administrator creation rolls back institution creation', function () {
    User::factory()->create([
        'email' => 'already-used@example.test',
    ]);

    try {
        Livewire::test(CreateInstitution::class)
            ->fillForm(institutionCreationData([
                'name' => 'Rollback Test College',
                'slug' => 'rollback-test-college',
                'admin_email' => 'already-used@example.test',
            ]))
            ->call('create');
    } catch (\Illuminate\Database\QueryException $exception) {
        // The unique email constraint may reject administrator creation.
    }

    expect(
        Institution::where('slug', 'rollback-test-college')->exists()
    )->toBeFalse();
});
