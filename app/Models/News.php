<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

#[Fillable(['title', 'slug', 'author', 'content', 'status'])]
#[Guarded(['id', 'created_at', 'updated_at'])]
class News extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static function booted()
    {
        static::creating(function ($news) {
            $news->slug = Str::slug($news->title);
        });

        /* static::deleting(function ($news) { */
        /*     $news->comment->each(function ($comment) { */
        /*         $comment->delete(); */
        /*     }); */
        /* }); */
        /**/
        /* static::restoring(function ($news) { */
        /*     $news->comment->each(function ($comment) { */
        /*         $comment->restore(); */
        /*     }); */
        /* }); */
    }


    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function rating(): MorphMany
    {
        return $this->morphMany(Rating::class, 'ratingable');
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categoriables');
    }
}
