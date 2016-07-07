<?php

namespace yewei\Access\Middleware;

use Closure;

class LevelMiddleware
{
	/**
	 * @var \Illuminate\Contracts\Auth\Guard
	 */
	protected $auth;
	
	/**
	 * Create a new filter instance.
	 *
	 * @param \Illuminate\Contracts\Auth\Guard $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
