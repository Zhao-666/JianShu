<?php

namespace App;

class Post extends BaseModel
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    public function zan($user_id)
    {
        return $this->hasOne('App\Zan')->where('user_id', $user_id);
    }

    public function zans()
    {
        return $this->hasMany('App\Zan');
    }
}
