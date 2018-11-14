<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //

    public function getCreatedAtAttribute($value)
    {
        return date('d.m.Y H:i:s', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d.m.Y H:i:s', strtotime($value));
    }
}
