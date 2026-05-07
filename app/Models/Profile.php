<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'bio', 'avatar', 'website'])]
#[Guarded(['id', 'created_at', 'updated_at', 'user_id'])]
class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    protected function avatar(): Attribute {
        return Attribute::make(
            get: function (?string $value) {
                if ($value) {
                    return asset('storage/' . $value);
                }

                $name = $this->user ? $this->user->username : 'User';

                return "https://ui-avatars.com/api/?name=" . urlencode($name) . "&background=random";
            }
        );
    }
}
