<?php

namespace App\Http\Middleware;

use App\Models\Etudiant as ModelsEtudiant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Etudiant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    
        if (!$request->session()->has('etudiant') && $request->route()->getName() !== 'etudiant.versLogin' && $request->route()->getName() !== 'etudiant.login') {
            return redirect()->route('etudiant.verslogin');
        }
        return $next($request);
    }
}
