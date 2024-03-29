<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Etudiant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        

        if(!Auth::check()){

            return redirect()->route('welcome')->with('error','Connectez-vous');

        }

        $user=Auth::user();

        if($user->role_id==1){

            return $next($request);

        }
        if($user->role_id==2){

            return redirect()->route('dashens');

        }

        if($user->role_id==3){

            return redirect()->route('dashadmin');

        }
     
    }
}
