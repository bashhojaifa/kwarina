<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function scopePublished($query)
    {
        return $query->where('status', true);
    }
}
