<?php

use App\Models\Institution;
use App\Models\User;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register through an institution', function () {
    $institution = Institution::create([
        'name' => 'Test Institution',
        'slug' => 'test-institution',
        'referral_code' => 'TEST-INSTITUTION',
    ]);

    $response = $this
        ->withSession([
            'selected_institution_id' => $institution->id,
        ])
        ->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

    $user = User::where('email', 'test@example.com')->firstOrFail();

    $this->assertAuthenticatedAs($user);

    $response->assertRedirect(route('classroom', absolute: false));

    $this->assertSame('student', $user->role);
    $this->assertSame($institution->id, $user->institution_id);
    $this->assertFalse((bool) $user->must_change_password);
    $this->assertTrue((bool) $user->initial_password_reset_required);
});
