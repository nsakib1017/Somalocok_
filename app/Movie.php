<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function comments(){
        return $this->hasMany('App\comment');
    }
    public function ratings(){
        return $this->hasMany('App\Rating');
    }
}
