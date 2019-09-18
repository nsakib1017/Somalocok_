<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function movie_id(){
        return $this->belongsTo('App\Movie');
    }
}
