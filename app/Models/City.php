<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class City extends Model
{
    public $timestamps = false;
    protected $table = 'cities';
    protected $fillable = ['name'];

    public function getUserCount(): int
    {
        return $this->hasMany(User::class)->count();
    }
}
