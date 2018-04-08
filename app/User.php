<?php

namespace App;

use \Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'password', 'email'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function fans()
    {
        return $this->hasMany(Fan::class, 'star_id', 'id');
    }

    public function stars()
    {
        return $this->hasMany(Fan::class, 'fan_id', 'id');
    }

    public function doFan($uid)
    {
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);
    }

    public function doUnFan($uid)
    {
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }

    public function hasFan($uid)
    {
        return $this->fans()->where('fan_id', $uid)->count();
    }

    public function hasStar($uid)
    {
        return $this->fans()->where('star_id', $uid)->count();
    }
}
