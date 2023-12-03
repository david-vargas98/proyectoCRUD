<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class, //usuario autenticado
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class, //autenticación HTTP básica
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class, //sesión aún válida
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class, //configura los encabezados de caché para las respuestas HTTP
        'can' => \Illuminate\Auth\Middleware\Authorize::class, //autorización basada en capacidad (permisos necesarios para acceder)
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, //Redirige a los usuarios autenticados lejos de ciertas rutas
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class, //pide al usuario ingresar su contraseña antes de realizar ciertas acciones
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class, //sistema de optimización de precarga 
        'signed' => \App\Http\Middleware\ValidateSignature::class, //valida que una solicitud tenga una firma válida
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, //evita abusos y ataques de fuerza bruta limitando la cantidad de solicitudes que un usuario puede hacer
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class, //verifica si la dirección de correo electrónico del usuario está verificada
    ];
}
