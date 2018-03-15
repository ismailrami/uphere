<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}