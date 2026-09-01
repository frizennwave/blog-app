<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model
{
    public function blogs(): MorphToMany
    {
        return $this->morphedByMany(Blog::class, 'categoriables');
    }

    public function news(): MorphToMany
    {
        return $this->morphedByMany(News::class, 'categoriables');
    }
}
