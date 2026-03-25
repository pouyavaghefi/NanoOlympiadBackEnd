<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AllowedIp;
class RestrictIPAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedIps = AllowedIp::where('domain', 'admin')->pluck('ip')->toArray();
        if($allowedIps){
            $userIp = $request->ip();

            if (in_array($userIp, $allowedIps)) {
                return $next($request);
            }

            abort(403, 'Access denied. Your IP is not allowed.');
        }else{
            return $next($request);
        }
    }
}