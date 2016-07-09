<?php

namespace yewei\Access;

use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    	$this->publishes([
    			__DIR__ . '/migrations/' => base_path('/database/migrations')
    	], 'migrations');
    	
    	$this->publishes([
    			__DIR__ . '/seeds/' => base_path('/database/seeds')
    	], 'seeds');
    	
    	$this->publishes([
    			__DIR__ . '/../config/access.php' => config_path('access.php')
    	], 'config');
    	
    	$this->loadViewsFrom(__DIR__ . '/views', 'access');
    	
    	$this->publishes([
    			__DIR__ . '/views' => base_path('resources/views')
    	],'view');
    	
    	$this->publishes([
    			__DIR__ . '/Controller' => base_path('App/Http/Controllers')
    	],'controller');
    	
    	$this->registerBladeExtensions();
    	
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    	$this->mergeConfigFrom(__DIR__ . '/../config/access.php', 'access');
    }
    
    
    /**
     * Register Blade extensions.
     *
     * @return void
     */
    protected function registerBladeExtensions()
    {
    	$blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();
    
    	$blade->directive('role', function ($expression) {
    		return "<?php if (Auth::check() && Auth::user()->is{$expression}): ?>";
    	});
    
    	$blade->directive('endrole', function () {
    		return "<?php endif; ?>";
    	});
    
    	$blade->directive('permission', function ($expression) {
    		return "<?php if (Auth::check() && Auth::user()->can{$expression}): ?>";
    	});
    
    	$blade->directive('endpermission', function () {
    		return "<?php endif; ?>";
    	});
    
    	$blade->directive('level', function ($expression) {
    		$level = trim($expression, '()');
	    	return "<?php if (Auth::check() && Auth::user()->level() >= {$level}): ?>";
    	});
    
    	$blade->directive('endlevel', function () {
    		return "<?php endif; ?>";
    	});
    
    	$blade->directive('allowed', function ($expression) {
    		return "<?php if (Auth::check() && Auth::user()->allowed{$expression}): ?>";
    	});
    
    	$blade->directive('endallowed', function () {
    		return "<?php endif; ?>";
    	});
    }
    
}
