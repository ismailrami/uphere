<?php

namespace App\Observers;

use App\Location;
use App\User;
use App\Events\Locationsent;


class LocationObserver 
{
    public function created(Location $location){
        $id = $location->user_id;
        $user = User::find($id);
        foreach ($user->followers as $follower) {
            $follower->notify(new LocationSent($user, $location));
        }
    }
    
}