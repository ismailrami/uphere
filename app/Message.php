<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'message','user_reciver','user_sender'
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function locations()
    {
        return $this->belongsTo('App\Location');
    }

    public function relations()
    {
    	return $this->belongsTo('App\Relation');
    }
}
