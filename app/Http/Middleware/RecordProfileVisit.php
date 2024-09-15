<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Visitor;

class RecordProfileVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Comprueba si el usuario autenticado es diferente del usuario cuyo perfil se está visitando
        if (Auth::check() && Auth::user()->id !== $request->route('userProfile_id')) {
            // Registra la visita en la base de datos
            Visitor::create([
                'user_id' => $request->route('userProfile_id'), // ID del usuario cuyo perfil se está visitando
                'visitor_id' => Auth::id(), // ID del usuario que realiza la visita (autenticado)
                'visited_at' => Carbon::now(),
            ]);
        }

        return $next($request);
    }
}
