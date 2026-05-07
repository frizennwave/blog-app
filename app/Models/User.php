<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

#[Fillable(['username', 'slug', 'email', 'password'])]
#[Guarded(['id', 'created_at', 'updated_at'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    // /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            $user->slug = Str::slug($user->username);
        });

        static::deleting(function ($user) {
            $user->profile->delete();
        });

        static::restoring(function ($user) {
            $user->profile->restore();
        });
    }

    public function profile(): HasOne {
        return $this->hasOne(Profile::class);
    }
}
