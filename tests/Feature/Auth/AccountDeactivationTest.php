<?php

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Facades\Filament;

test('active users can log in', function () {
    $user = User::factory()->create([
        'is_active' => true,
        'role' => 'student',
        'must_change_password' => false,
        'initial_password_reset_required' => false,
    ]);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticatedAs($user);
});

test('deactivated users cannot log in', function () {
    $user = User::factory()->create([
        'is_active' => false,
        'role' => 'student',
    ]);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertGuest();
});

test('deactivated users with existing sessions are logged out', function () {
    $user = User::factory()->create([
        'is_active' => false,
    ]);

    $response = $this->actingAs($user)->get('/profile');

    $this->assertGuest();
    $response->assertRedirect(route('login'));
});

test('permanent user deletion is disabled', function () {
    $user = User::factory()->create();

    expect(UserResource::canDelete($user))->toBeFalse();
    expect(UserResource::canDeleteAny())->toBeFalse();
});

test('inactive administrators cannot access the Filament panel', function () {
    $user = User::factory()->create([
        'is_admin' => 1,
        'is_active' => false,
    ]);

    $panel = Filament::getPanel('admin');

    expect($user->canAccessPanel($panel))->toBeFalse();
});
