<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(!$request->hasHeader('Authorization')) {
          return response()->json('Authorization Header not found', 401);
        }

        if($request->header('Authorization') == null) {
          return response()->json('No token provided', 401);
        }

        if ($request->header('Authorization')) {
          $key = $request->header('Authorization');
          $user = User::where('api_key', $key)->first();
          if(empty($user)){
            return response()->json('Unauthorised :()', 401);
          }

        }

        return $next($request);
    }
}
