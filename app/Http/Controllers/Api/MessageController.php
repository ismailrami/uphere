<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;


class MessageController extends Controller
{
    public function index(){

    	$user = Auth::user();

    	$id = $user->id;

    	$message = Message::where('user_reciver',$id)->get();

    	return response()->json(['data' => $message], 200, [], JSON_NUMERIC_CHECK);

    }


    public function get(Request $request)
    {
        $message = Message::find($request->id)->get();

        return response()->json(['data' => $message], 200, [], JSON_NUMERIC_CHECK);
    }


    public function create(Request $request){

    	$user = Auth::user();
    	$id = $user->id;

    	$this->validate($request, [
    		'message'=> 'required',
    		'user_reciver' => 'required'
    	]);

    	

    	$message = Message::create([
    		'message' => request('message'),
    		'user_sender' => $id,
    		'user_reciver' => request('user_reciver')
    	]);

    	

    	return response()->json(['data' => $message->id], 200, [], JSON_NUMERIC_CHECK);
    }


    public function delete(Request $request)
    {
        $user = Auth::user();

        $message = Message::where('user_reciver', $request->id)->get();
    }


    
}