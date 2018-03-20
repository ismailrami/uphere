<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Location;
use App\Relation;



class LocationController extends Controller
{
	public function index()
	{
		$user = Auth::user();

    	$id = $user->id;
    	$locations = array();

    	$relation = $user->relations()->get();

    	foreach ($relation as $r ) {
    		$user = User::find($r->relation);
    		$location = new Location();
    		$location = $user->locations()->first();
    		array_push($locations, $location);
    	}

    	return response()->json(['data' => $locations ], 200, [], JSON_NUMERIC_CHECK);
	}


    public function addLocation(Request $request)
    {
        $user = Auth::user();

        $location = new Location();

        $this->validate($request,[
                'latitude'  => 'required',
                'longitude' => 'required',
                'adresse'   => 'required',
                'message_id'=> 'required'
                
        ]);

        $location = Location::create([
                'latitude'  => request('latitude'),
                'longitude' => request('longitude'),
                'adresse'   => request('adresse'),
                //to change recive id of message from the app
                'message_id'=> request('message_id'),
                'user_id'   => $user->id
            ]);


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
}