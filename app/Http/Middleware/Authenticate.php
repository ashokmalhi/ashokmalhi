<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($route)
    {
        //if (! $request->expectsJson()) {
            return route($route);
        //}
    }


    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        $route = 'login';
        if(in_array('player_admin',$guards)){
            $route = 'playerLogin';
        }
        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($route)
        );
    }
}
