<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Location;
use App\Notifications\UserFollowed;




class UserController extends Controller
{

	public function follow(User $user)
    {
        $follower = Auth::user();
        if ($follower->id == $user->id) {
           return response()->json(['data' => 'failed' ], 504, [], JSON_NUMERIC_CHECK);
        }
        
            $follower->follow($user->id);
            $user->notify(new UserFollowed($follower));
            return response()->json(['data' => 'success' ], 200, [], JSON_NUMERIC_CHECK);
        
	}
	

    public function unfollow(User $user)
    {
        $follower = Auth::user();
        if($follower->isFollowing($user->id)) {
            $follower->unfollow($user->id);
            return response()->json(['data' => "success" ], 200, [], JSON_NUMERIC_CHECK);
        }
        return response()->json(['data' => "failed" ], 504, [], JSON_NUMERIC_CHECK);
	}
	

    public function notifications()
    {
        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
    }
}