<?php

namespace yewei\Access\Traits;

use Illuminate\Database\Eloquent\Model;
use yewei\Access\Models\Permission;
use yewei\Access\Models\Role;

trait UserAccessTRaits {
	
	/**
	 * Traits\Permission
	 * Traits\Permission
	 * Property for caching roles.
	 */
	protected $roles;
	
	/**
	 * Handle dynamic method calls.
	 *
	 * @param string $method
	 * @param array $parameters
	 * @return boolean
	 */
	public function __call($method, $parameters)
	{
		if (starts_with($method, 'is')) {
			return $this->is(snake_case(substr($method, 2),config('access.placeholder')));
		} elseif (starts_with($method, 'can')) {
			return $this->can(snake_case(substr($method, 3),config('access.placeholder')));
		} 	
		return parent::__call($method, $parameters);
	}
	
	/**
     * User belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function roles(){
		return $this->belongsToMany(config('access.models.role'))->withTimestamps();
	}
	
	/**
	 * assign a role to a user.
	 * @param $role
	 * @return bool
	 * 
	 */
	public function assignRole(Role $role){
		return $this->roles()->save($role);
	}
	
	/**
	 * Attach role to a user.
	 *
	 * @param int|\Bican\Roles\Models\Role $role
	 * @return null|bool
	 */
	public function attachRole($role)
	{
		return (!$this->getRoles()->contains($role)) ? $this->roles()->attach($role) : true;
	}
	
	/**
	 * Detach role from a user.
	 *
	 * @param int|\Bican\Roles\Models\Role $role
	 * @return int
	 */
	public function detachRole($role)
	{
		$this->roles = null;
	
		return $this->roles()->detach($role);
	}
	
	/**
	 * Detach all roles from a user.
	 *
	 * @return int
	 */
	public function detachAllRoles()
	{
		$this->roles = null;
	
		return $this->roles()->detach();
	}
	
	/**
	 * Check if the user has role.
	 *
	 * @param int|string $role
	 * @return bool
	 */
	public function hasRole($role){// $role is a string here
		if(is_string($role)){
			return $this->getRoles()->contains('name',$role);
		}
		return !! $role->intersect($this->getRoles())->count();
	}
	
	/**
	 * Get all roles as collection.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getRoles()
	{
		return (!$this->roles) ? $this->roles = $this->roles()->get() : $this->roles;
	}
	
	
	/**
	 * Check if the user has a role or roles.
	 *
	 * @param int|string|array $role
	 * @param bool $all
	 * @return bool
	 */
	public function is($role, $all = false)
	{
		return $this->{$this->getMethodName('is', $all)}($role);
	}
	
	
	/**
	 * Check if the user has at least one role.
	 *
	 * @param int|string|array $role
	 * @return bool
	 */
	public function isOne($role)
	{
		foreach ($this->getArrayFrom($role) as $role) {
			if ($this->hasRole($role)) {
				return true;
			}
		}
	
		return false;
	}
	
	/**
	 * Check if the user has all roles.
	 *
	 * @param int|string|array $role
	 * @return bool
	 */
	public function isAll($role)
	{
		foreach ($this->getArrayFrom($role) as $role) {
			if (!$this->hasRole($role)) {
				return false;
			}
		}
	
		return true;
	}
	
	/**
	 * Check if the user has a permission or permissions.
	 *
	 * @param int|string|array $permission
	 * @param bool $all
	 * @return bool
	 */
	public function can($permission, $all = false)
	{
		return $this->{$this->getMethodName('can', $all)}($permission);
	}
	
	/**
	 * Check if the user has at least one permission.
	 *
	 * @param int|string|array $permission
	 * @return bool
	 */
	public function canOne($permission)
	{
		foreach ($this->getArrayFrom($permission) as $permission) {
			if ($this->hasPermission($permission)) {
				return true;
			}
		}
	
		return false;
	}
	
	/**
	 * Check if the user has all permissions.
	 *
	 * @param int|string|array $permission
	 * @return bool
	 */
	public function canAll($permission)
	{
		foreach ($this->getArrayFrom($permission) as $permission) {
			if (!$this->hasPermission($permission)) {
				return false;
			}
		}
	
		return true;
	}
	
	/**
	 * Get all permissions as collection.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function getAllPermissions()
	{
		return Permission::all();
	}
	
	/**
	 * Check if the user has the permission to access this route.
	 * 
	 * @param string $routes_str
	 * @return bool
	 */
	public function RoutemMatchPermission($routes_str){
		
		$routes = explode(".",$routes_str);
		
		foreach ($routes as $route){
			
			if(!$this->checkPerm($route)){
				return false;
			}
			
		}
		return true;
	}
	
	/**
	 * check if the user has the permission to access the route or the route is in the permissions list.
	 * 
	 * @param string $route
	 * @return boolean
	 */
	public function checkPerm($route){
		
		if(!$this->hasPermission($route)){
			foreach ($this->getAllPermissions() as $perm){
				if($perm->name == $route){
					return false;
				}
			}
			return true;
		}
		return true;
		
	}
	
	/**
	 * Check if user has a permission by its name or id.
	 *
	 * @param  string $nameOrId Permission name or id.
	 * @return bool
	 */
	public function hasPermission($nameOrId)
	{
		foreach ($this->getRoles() as $role) {
			// Validate against the Permission table
			foreach ($role->permissions as $perm) {
				
				//First check to see if it's an ID
				if (is_numeric($nameOrId)) {
					if ($perm->id == $nameOrId) {
						return true;
					}
				}
	
				//Otherwise check by name
				if ($perm->name == $nameOrId) {
					return true;
				}
			}
		}
		return false;
	}
	
	/**
	 * Get an array from argument.
	 *
	 * @param int|string|array $argument
	 * @return array
	 */
	private function getArrayFrom($argument)
	{
		return (!is_array($argument)) ? preg_split('/ ?[,|_] ?/', $argument) : $argument;
	}
	
	/**
	 * Get role level of a user.
	 *
	 * @return int
	 */
	public function level()
	{
		return ($role = $this->getRoles()->sortByDesc('level')->first()) ? $role->level : 0;
	}
	
	/**
	 * Get method name.
	 *
	 * @param string $methodName
	 * @param bool $all
	 * @return string
	 */
	private function getMethodName($methodName, $all)
	{
		return ((bool) $all) ? $methodName . 'All' : $methodName . 'One';
	}
	
}