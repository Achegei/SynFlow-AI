<?php

use App\Models\Institution;

function createHomepageInstitution(
    string $name,
    array $overrides = []
): Institution {
    return Institution::create(array_merge([
        'name' => $name,
        'slug' => \Illuminate\Support\Str::slug($name),
        'status' => 'active',
        'wallet_balance' => 0,
        'show_on_homepage' => true,
        'display_order' => 0,
    ], $overrides));
}

test('homepage displays approved active institutional partners', function () {
    createHomepageInstitution('Approved Test College', [
        'public_description' => 'Approved institutional partnership.',
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee('Our Institutional Partners')
        ->assertSee('Approved Test College')
        ->assertSee('Approved institutional partnership.');
});

test('homepage hides institutions not approved for publication', function () {
    createHomepageInstitution('Private Test College', [
        'show_on_homepage' => false,
    ]);

    $this->get('/')
        ->assertOk()
        ->assertDontSee('Private Test College')
        ->assertDontSee('Our Institutional Partners');
});

test('homepage hides suspended and pending institutions', function () {
    createHomepageInstitution('Suspended Test College', [
        'status' => 'suspended',
    ]);

    createHomepageInstitution('Pending Test College', [
        'status' => 'pending',
    ]);

    $this->get('/')
        ->assertOk()
        ->assertDontSee('Suspended Test College')
        ->assertDontSee('Pending Test College');
});

test('homepage orders institutional partners by display order', function () {
    createHomepageInstitution('Second Test College', [
        'display_order' => 20,
    ]);

    createHomepageInstitution('First Test College', [
        'display_order' => 10,
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSeeInOrder([
            'First Test College',
            'Second Test College',
        ]);
});

test('homepage works when no institutions are approved', function () {
    $this->get('/')
        ->assertOk()
        ->assertDontSee('Our Institutional Partners');
});

test('homepage displays learner initials when photographs are unavailable', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Wekesa Mark Tobbie')
        ->assertSee('Abdiweli Ali Musse')
        ->assertSee('Joseph Juma')
        ->assertSee('WT')
        ->assertSee('AM')
        ->assertSee('JJ');
});
