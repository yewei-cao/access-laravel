<?php

namespace yewei\Access\Models;

use yewei\Access\Traits\Slugstr;
use yewei\Access\Traits\RoleTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	use Slugstr,RoleTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'level'];
    
}
