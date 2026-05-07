<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable('comment', 'blog_id')]
class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function blog():BelongsTo {
        return $this->belongsTo(Blog::class);
    }
}
