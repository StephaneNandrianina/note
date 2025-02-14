<?php

namespace App\Http\Middleware;

use App\Models\Admin as ModelsAdmin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = session()->get('utilisateur');
        $utilisateur = ModelsAdmin::where('idadmin', $id)->first();
        if (is_null($utilisateur)) {
            return redirect()->route('admin.versLogin');
        }
        return $next($request);
    }
}
