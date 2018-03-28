<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Location;

use App\Notifications\SendLocation;



class LocationController extends Controller
{
	public function index()
	{
		$user = Auth::user();

    	$id = $user->id;
    	$locations = array();

    	$folowers = $user->folowers();

    	foreach ($folowers as $f ) {
    		
    		$location = new Location();
    		$location = $f->locations()->first();
    		array_push($locations, $location);
    	}

    	return response()->json(['data' => $locations ], 200, [], JSON_NUMERIC_CHECK);
	}


    public function addLocation(Request $request)
    {
        $user = Auth::user();

        

        $this->validate($request,[
                'latitude'  => 'required',
                'longitude' => 'required',
                'adresse'   => 'required',
                'message'=> 'required'
                
        ]);

        $location = Location::create([
                'latitude'  => request('latitude'),
                'longitude' => request('longitude'),
                'adresse'   => request('adresse'),
                'message'   => request('message'),
                'user_id'   => $user->id
            ]);
            $destination_user = User::find($request->user);
            $destination_user->notify(new SendLocation($location));


        return response()->json(['data' => 'success' ], 200, [], JSON_NUMERIC_CHECK);
    }


    public function getLocation($id)
    {
        $location = Location::find($id);

        return response()->json(['data' => $location ], 200, [], JSON_NUMERIC_CHECK);
    }
    public function deleteLocation($id)
    {
        $location = Location::find($id)->delete();

        return response()->json(['data' => 'success' ], 200, [], JSON_NUMERIC_CHECK);
    }

    public function notifications()
    {
        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
    }
}