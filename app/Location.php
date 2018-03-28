<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	protected $fillable = [
        'latitude', 'longitude','adresse','message','user_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

   
}
