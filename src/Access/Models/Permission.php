<?php

namespace yewei\Access\Models;

use yewei\Access\Traits\Slugstr;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	use Slugstr;
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'model'];
	
    
	/**
	 * Permissions can be belonged by many roles.
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function roles(){
		return $this->belongsToMany(Role::class)->withTimestamps();
	}
    
}
