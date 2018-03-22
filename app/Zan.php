<?php

namespace App;


class Zan extends BaseModel
{
    public function posts(){
        return $this->belongsTo('App\Post');
    }
}
