<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function ($e, Request $request) {
            if ($e instanceof AuthorizationException || ($e instanceof HttpException && $e->getStatusCode() === 403)) {
                if ($request->expectsJson()) {
                    return Redirect::route('home')->with('error', 'Accès refusé.');
                }
                return Redirect::route('home')->with('error', 'Accès refusé.');
            }
            return parent::render($request, $e);
        });
    })->create();
