<?php

namespace yewei\Access\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use yewei\Access\Exception\PermissionDeniedException;
use Illuminate\Support\Facades\Route;

class AccessMiddleware
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
    	$permission = $request->route()->getName();
    	
    	if ((! $this->auth->user()->RoutemMatchPermission($permission))&&($permission)) {
    		throw new PermissionDeniedException($permission);
    	}
    	
        return $next($request);
    }
}
