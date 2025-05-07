<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    public $timestamps = false;
    protected $table = 'post_likes';
    protected $fillable = ['post_id', 'user_id', 'created_at'];
    const CREATED_AT = 'created_at';
}
