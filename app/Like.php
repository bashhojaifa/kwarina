<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function scopeLikes($query)
    {
        return $query->where('like', 1);
    }

    public function scopeDislikes($query)
    {
        return $query->where('like', 0);
    }

}
