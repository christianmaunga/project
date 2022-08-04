<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // if (! $request->expectsJson()) {
        //     return route('login');
        // }

        if($request->routeIs('admin.*')){
            return route('admin.login');
            //login as admin fails 
        }

        if($request->routeIs('stock.*')){
            return route('stock.login');
            //login as stock fails 
        }

        if($request->routeIs('pharma.*')){
            return route('pharma.login');
            //login as stock fails 
        }
        if($request->routeIs('poulailler.*')){
            return route('poulailler.login');
            //login as stock fails 
        }
        return route('login');
    }
}
