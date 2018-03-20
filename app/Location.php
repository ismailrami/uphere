<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	protected $fillable = [
        'latitude', 'longitude','adresse','message_id','user_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function messages()
    {
        return $this->hasOne('App\Message');
    }
}
