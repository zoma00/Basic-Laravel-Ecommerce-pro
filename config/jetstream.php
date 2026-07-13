<?php

use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Middleware\AuthenticateSession;

return [
    'stack' => 'livewire',
    'middleware' => ['web'],
    'auth_session' => AuthenticateSession::class,
    'guard' => 'web',

    // Jetstream-specific features
    'features' => [
        Features::profilePhotos(),    // Profile photo uploads
        Features::accountDeletion(),  // User self-account removal
        // Features::api(),
    ],  // <-- COMMA ADDED HERE

    'profile_photo_disk' => 'public',
    'middleware_group' => 'web',
    'password_reset' => [
        'expire' => 60,
        'throttle' => 60,
    ],
];
