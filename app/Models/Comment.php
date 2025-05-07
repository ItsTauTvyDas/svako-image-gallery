<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'post_comments';
    protected $fillable = ['post_id', 'user_id', 'content'];

    public function author(): null|User
    {
        return $this->belongsTo(User::class, 'user_id')->first();
    }
}
