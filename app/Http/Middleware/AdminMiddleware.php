<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnums;
use App\Enums\StatusEnums;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): HttpResponse | RedirectResponse | JsonResponse
    {
        if(Auth::user()->status === StatusEnums::Disable->value){
            Auth::logout();

            return $this->unauthorizedResponse($request, 'Profile Disabled');
        }

        if(Auth::user()->status === StatusEnums::Suspendened->value){
            Auth::logout();

            return $this->unauthorizedResponse($request, 'Profile Suspended');
        }

        if(Auth::check() && Auth::user()->role === RoleEnums::Administrator->value){
            return $next($request);
        }

        if(Auth::check() && Auth::user()->role === RoleEnums::SuperAdministrator->value ){
            return $next($request);
        }


        return $this->unauthorizedResponse($request, 'You do not have admin access');
    }

    private function unauthorizedResponse($request, $message)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message], 403);
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('message', $message);
    }
}
