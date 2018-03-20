<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Location;
use App\Relation;



class RelationController extends Controller
{
	public function index()
	{
		$user = Auth::user();

    	$id = $user->id;

    	$relations = Relation::where('user_id',$id)->get();

    	return response()->json(['data' =>  $relations], 200, [], JSON_NUMERIC_CHECK);


	}


	public function create(Request $request)
	{
		$user = Auth::user();

    	$id_user = $user->id;
    	$is_there = true;

    	$relation = new Relation;
    	$relations = Relation::where('user_id',$id_user)->get();
    	foreach ($relations as $r) {
    		if($r->relation==$request->id)
    		{
    			$is_there = false;
    		}
    	}
    	if($is_there){
	    	$relation=Relation::create([
	    		'user_id' => $id_user,
	    		'relation' => request('id')
	    		]);

	    	$relation->save();
	    	return response()->json(['data' => 'success' ], 200, [], JSON_NUMERIC_CHECK);
    	}


    	return response()->json(['data' => 'probleme'], 400, [], JSON_NUMERIC_CHECK);

	}


	public function delete(Request $request)
	{
		$user = Auth::user();

    	

		$relation = $user->relations()->where('relation', $request->id)->delete();
		

		return response()->json(['data' => 'success'], 200, [], JSON_NUMERIC_CHECK);

	}
}