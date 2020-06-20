<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function scopeNewNotifications($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOldNotifications($query)
    {
        return $query->where('status', 0);
    }
}
