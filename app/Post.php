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
        return $this->hasMany('App\Comment')->orderBy('create_at', 'desc');
    }
}
