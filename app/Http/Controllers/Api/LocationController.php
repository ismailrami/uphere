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

    	$relation = Relation::where('owner',$id)->get();

    	foreach ($relation as $r ) {
    		$user = User::find($r->relation);
    		$location = new Location();
    		$location = $user->locations()->first();
    		array_push($locations, $location);
    	}

    	return response()->json(['data' => $locations ], 200, [], JSON_NUMERIC_CHECK);
	}
}