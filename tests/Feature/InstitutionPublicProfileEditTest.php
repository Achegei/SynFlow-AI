<?php

use App\Filament\Resources\InstitutionResource\Pages\EditInstitution;
use App\Models\Institution;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Livewire;

test('editing institutional public profile preserves administrator account', function () {
    $panel = Filament::getPanel('admin');
    Filament::setCurrentPanel($panel);
    $panel->boot();

    $operator = User::factory()->create([
        'is_admin' => true,
        'role' => 'admin',
    ]);

    $this->actingAs($operator);

    $institution = Institution::create([
        'name' => 'Public Profile Test College',
        'slug' => 'public-profile-test-college',
        'contact_person' => 'College Contact',
        'email' => 'college@example.test',
        'phone' => '0712345678',
        'status' => 'active',
        'wallet_balance' => 0,
        'show_on_homepage' => false,
        'display_order' => 0,
    ]);

    $administrator = User::factory()->create([
        'name' => 'Original College Administrator',
        'email' => 'original-admin@example.test',
        'role' => 'institution_admin',
        'institution_id' => $institution->id,
    ]);

    $institution->update([
        'institution_admin_id' => $administrator->id,
    ]);

    $originalPassword = $administrator->password;

    Livewire::test(EditInstitution::class, [
        'record' => $institution->getRouteKey(),
    ])
        ->assertSuccessful()
        ->fillForm([
            'website_url' => 'https://example.org',
            'public_description' => 'Official institutional partnership profile.',
            'display_order' => 10,
            'show_on_homepage' => true,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $institution->refresh();
    $administrator->refresh();

    expect($institution->website_url)->toBe('https://example.org')
        ->and($institution->public_description)->toBe(
            'Official institutional partnership profile.'
        )
        ->and($institution->display_order)->toBe(10)
        ->and($institution->show_on_homepage)->toBeTrue()
        ->and($administrator->name)->toBe('Original College Administrator')
        ->and($administrator->email)->toBe('original-admin@example.test')
        ->and($administrator->password)->toBe($originalPassword)
        ->and($institution->institution_admin_id)->toBe($administrator->id);
});
