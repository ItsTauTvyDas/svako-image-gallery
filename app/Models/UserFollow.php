<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{
    protected $table = 'follows';
    public $timestamps = false;
    protected $fillable = ['following_user_id', 'followed_user_id', 'created_at'];
    const CREATED_AT = 'created_at';
}
