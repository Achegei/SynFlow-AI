<?php

use App\Filament\Resources\GalleryImageResource;
use App\Models\User;
use Filament\Facades\Filament;

beforeEach(function () {
    $panel = Filament::getPanel('admin');

    Filament::setCurrentPanel($panel);
    $panel->boot();
});

test('active administrator can access gallery management', function () {
    $admin = User::factory()->create([
        'is_admin' => true,
        'is_active' => true,
        'role' => 'admin',
        'must_change_password' => false,
    ]);

    $this->actingAs($admin);

    expect(GalleryImageResource::canViewAny())->toBeTrue()
        ->and(GalleryImageResource::canCreate())->toBeTrue();

    $this->get('/admin/gallery-images')->assertOk();

    $this->get('/admin/gallery-images/create')->assertOk();
});

test('ordinary user cannot access gallery management', function () {
    $user = User::factory()->create([
        'is_admin' => false,
        'is_active' => true,
        'role' => 'client',
    ]);

    $this->actingAs($user);

    expect(GalleryImageResource::canViewAny())->toBeFalse()
        ->and(GalleryImageResource::canCreate())->toBeFalse();

    $this->get('/admin/gallery-images')->assertForbidden();

    $this->get('/admin/gallery-images/create')->assertForbidden();
});

test('institution administrator cannot access gallery management', function () {
    $user = User::factory()->create([
        'is_admin' => false,
        'is_active' => true,
        'role' => 'institution_admin',
    ]);

    $this->actingAs($user);

    expect(GalleryImageResource::canViewAny())->toBeFalse()
        ->and(GalleryImageResource::canCreate())->toBeFalse();

    $this->get('/admin/gallery-images')->assertForbidden();

    $this->get('/admin/gallery-images/create')->assertForbidden();
});

test('inactive administrator cannot access gallery management', function () {
    $admin = User::factory()->create([
        'is_admin' => true,
        'is_active' => false,
        'role' => 'admin',
    ]);

    $this->actingAs($admin);

    expect(GalleryImageResource::canViewAny())->toBeFalse()
        ->and(GalleryImageResource::canCreate())->toBeFalse();

    $this->get('/admin/gallery-images')
        ->assertRedirect(route('login'));

    $this->assertGuest();

    $this->get('/admin/gallery-images/create')
        ->assertForbidden();
});

test('unauthenticated visitor cannot access gallery management', function () {
    expect(GalleryImageResource::canViewAny())->toBeFalse()
        ->and(GalleryImageResource::canCreate())->toBeFalse();

    $this->get('/admin/gallery-images')->assertForbidden();

    $this->get('/admin/gallery-images/create')->assertForbidden();
});
