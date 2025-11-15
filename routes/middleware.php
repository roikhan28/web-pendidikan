<?php

use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

return [
    'aliases' => [
        'auth' => Authenticate::class,
        'guest' => RedirectIfAuthenticated::class,
        'verified' => EnsureEmailIsVerified::class,
        'role' => RoleMiddleware::class,
    ],

    'groups' => [
        'web' => [
            // Middleware web sudah di-pipe dari bootstrap/app.php
        ],
        'api' => [
            // Ditetapkan di bootstrap/app.php
        ],
    ],
];
