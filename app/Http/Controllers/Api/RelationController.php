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

    	return response()->json(['data' => $relations ], 200, [], JSON_NUMERIC_CHECK);


	}


	public function create(Request $request)
	{
		$user = Auth::user();

    	$id__user = $user->id;

    	$relation = new Relation;

    	$relation=Relation::create([
    		'user_id' => $id__user,
    		'relation' => request('id')
    	]);
    	$relation->save();


    	return response()->json(['data' => 'success' ], 200, [], JSON_NUMERIC_CHECK);

	}


	public function delete(Request $request)
	{
		$user = Auth::user();

    	

		$relation = $user->relations()->where('relation', $request->id)->delete();
		

		return response()->json(['data' => 'success'], 200, [], JSON_NUMERIC_CHECK);

	}
}