<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * @method static where(string $string, string $string1, string $string2)
 * @method static whereRaw(string $string, string[] $array)
 */
class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'user_id', 'image_url'];

    public function author(): null|User
    {
        return $this->belongsTo(User::class, 'user_id')->first();
    }

    public function likeCount(): int
    {
        return $this->likes()->count();
    }

    public function likes(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (Post $post) {
            if ($post->image_url)
                Storage::disk('public')->delete($post->image_url);
        });
    }
}
