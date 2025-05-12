<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnums;
use App\Enums\StatusEnums;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response | RedirectResponse | JsonResponse
    {
        if(Auth::user()?->status === StatusEnums::Disable->value){
            Auth::logout();

            return redirect(route('login'))->with('error','Profile Disable');
        }

        if(Auth::user()?->status === StatusEnums::Suspendened->value){
            Auth::logout();

            return redirect(route('login'))->with('error','Profile Supended');
        }

        if(Auth::check() && Auth::user()?->role === RoleEnums::SuperAdministrator->value){

            return $next($request);
        }

        return redirect()->route('dashboard.users')->with('error', 'You do not have admin access');

    }
}
