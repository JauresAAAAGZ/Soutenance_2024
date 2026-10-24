<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    // Correspond aux identifiants de la table roles
    private const ROLES = [
        'etudiant' => 1,
        'professeur' => 2,
        'admin' => 3,
        'serviceexamen' => 4,
    ];

    /**
     * Exemple : ->middleware('role:professeur') ou ->middleware('role:etudiant,professeur')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $autorises = array_map(fn ($role) => self::ROLES[$role], $roles);

        if (!$request->user() || !in_array($request->user()->role_id, $autorises)) {
            abort(403, 'Accès refusé.');
        }

        return $next($request);
    }
}
