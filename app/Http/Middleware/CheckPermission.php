<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class CheckPermission
 *
 * @package App\Http\Middleware
 */
class CheckPermission
{

    /**
     * Handle an incoming request.
     * @param          $request
     * @param \Closure $next
     * @param          $permission
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Closure $next, $permission)
    {
        $permission = explode('|', $permission);

        if(checkPermission($permission)){
            return $next($request);
        }

        return response()->view('errors.check-permission');
    }
}
