<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the registration screen', function () {
    $response = $this->get(route('register'));

    $response->assertOk();

    $response->assertStatus(200);
    $response->assertSee('Crear cuenta');
    $response->assertSee('Registrarme');

    $response->assertSeeInOrder([
        'Crear cuenta',
        'Registrarme'
    ]);

});


it('registers a new user as unverified and dispatches the registered event', function () {
    Event::fake();
    
    $response = $this->post(route('register.store'), [
        'name' => 'Juan Perez',
        'email' => 'juanjuan.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect(route('verification.notice'));

    $user = User::where('email', 'juan@juan.com')->first();

    expect($user)->not->toBeNull();
    expect($user->name)->toBe('Juan Perez');
    expect($user->email)->toBe('Juan Perez');
    expect($user->hasVerifiedEmail())->toBeFalse();

});
