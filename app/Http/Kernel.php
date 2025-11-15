<?php
// ...existing code...
protected $middleware = [
    // ...existing global middleware...
    // Remove this line if present:
    // \Illuminate\Routing\Middleware\SubstituteBindings::class,
];
// ...existing code...

protected $middlewareGroups = [
    'web' => [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        // ...existing web middleware...
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class, // ensure this line exists here
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ],
    // ...existing code...
];
// ...existing code...