<?php

namespace App\Http\Middleware;

use App\Models\Joueur;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserVerfi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, callable $next, $paramKey = 'id', $routeName = 'home'): Response
    {
        $user = $request->user();
        $joueur = Joueur::findOrFail($request->route($paramKey));
        $targetUser = $joueur->user;

        if ($user->role === 'user' && $user->id !== $targetUser->id) {
            return redirect()->route($routeName)
                            ->with('error', 'Vous ne pouvez pas supprimer cet utilisateur.');
        }

        if ($user->role === 'coach' && $targetUser->role !== 'user' && $user->id !== $targetUser->id) {
            return redirect()->route($routeName)
                            ->with('error', 'Vous ne pouvez pas supprimer cet utilisateur.');
        }

        // Si aucune condition n’est déclenchée, continue la requête
        return $next($request);
    }
}
