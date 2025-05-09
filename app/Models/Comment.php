<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find(int $markForDeletionId)
 */
class Comment extends Model
{
    protected $table = 'post_comments';
    protected $fillable = ['post_id', 'user_id', 'content'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
