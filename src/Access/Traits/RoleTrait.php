<?php

namespace yewei\Access\Traits;

trait RoleTrait{
	
	/**
	 * Roles can be belonged by many users.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users(){
		return $this->belongsToMany(config('auth.providers.users.model'))->withTimestamps();
	}
	/**
	 * Roles can have many permissions.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function permissions(){
		return $this->belongsToMany(config('access.models.permission'))->withTimestamps();
	}
	/**
	 * Attach permission to a role.
	 * @param int|\Bican\Roles\Models\Permission $permission
	 * @return int|bool
	 */
	public function attachPermission($permission)
	{
		return (!$this->permissions()->get()->contains($permission)) ? $this->permissions()->attach($permission) : true;
	}
	
	/**
	 * Detach permission from a role.
	 * @param int|\Bican\Roles\Models\Permission $permission
	 * @return int
	 */
	public function detachPermission($permission)
	{
		return $this->permissions()->detach($permission);
	}
	
	/**
	 * Attache Permissions For a Role.
	 * @param unknown $perms
	 * @return boolean
	 */
	public function attachePermissions($perms)
	{
		if(is_array($perms))
		{
			foreach($perms as $perm){
				$this->attachPermission($perm);
			}
		}else{
			$this->attachPermission($perms);
		}
		return true;
	}
	
	/**
	 * Detach all permissions.
	 * @return int
	 */
	public function detachAllPermissions()
	{
		return $this->permissions()->detach();
	}
	
	
}