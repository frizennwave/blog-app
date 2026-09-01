<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

#[Fillable(['title', 'slug', 'author', 'content'])]
#[Guarded(['id', 'created_at', 'updated_at'])]
class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static function booted()
    {
        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->title);
        });

        static::deleting(function ($blog) {
            $blog->comment->each(function ($comment) {
                $comment->delete();
            });
        });

        static::restoring(function ($blog) {
            $blog->comment->each(function ($comment) {
                $comment->restore();
            });
        });
    }

    public function comment():HasMany {
        return $this->hasMany(Comment::class);
    }

    public function tags():BelongsToMany {
        return $this->belongsToMany(Tag::class);
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
