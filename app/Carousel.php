<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    public function scopePublished($query){
        return $query->where('status', 1);
    }

    public function scopeNonPublished($query){
        return $query->where('status', 0);
    }

}
