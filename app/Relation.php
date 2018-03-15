<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
	protected $fillable = [
        'user_id','relation'
    ];


    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}