<?php

namespace yewei\Access\Traits;

use Illuminate\Support\Str;

trait Slugstr
{
    /**
     * Set slug attribute.
     *
     * @param string $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value,  config('access.placeholder'));
    }
}
