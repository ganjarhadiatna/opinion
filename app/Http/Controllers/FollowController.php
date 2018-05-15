<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\FollowModel;
use App\NotifModel;
use App\ProfileModel;
use App\TagModel;

class FollowController extends Controller
{
    function following($iduser)
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        $profile = FollowModel::GetUserFollowing($iduser, $id);
        $ttl_following = FollowModel::GetTotalFollowing($iduser);
        $topUsers = ProfileModel::TopUsers($id, 10);
        $topTags = TagModel::TopTags(10);
        return view('profile.following', [
            'title' => 'Following',
            'path' => 'profile',
            'profile' => $profile,
            'ttl_following' => $ttl_following,
            'topTags' => $topTags,
            'topUsers' => $topUsers
        ]);
    }
    function followers($iduser)
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        $profile = FollowModel::GetUserFollowers($iduser, $id);
        $ttl_followers = FollowModel::GetTotalFollowers($iduser);
        $topUsers = ProfileModel::TopUsers($id, 10);
        $topTags = TagModel::TopTags(10);
        return view(
            'profile.followers', [
            'title' => 'Followers',
            'path' => 'profile',
            'profile' => $profile,
            'ttl_followers' => $ttl_followers,
            'topTags' => $topTags,
            'topUsers' => $topUsers
        ]);
    }
    function add(Request $request)
    {
    	$id = Auth::id();
    	$iduser = $request['iduser'];

    	//check following
    	$ck = FollowModel::Check($iduser, $id);
    	if (is_int($ck)) {
    		echo "failed";
    	} else {
    		$data = array(
	    		'following' => $iduser,
	    		'followers' => $id
	    	);
	    	//save to follow
	    	$rest = FollowModel::Add($data);
	    	if ($rest) {
                //add notif
                $notif = array(
                    'id' => $id,
                    'iduser' => $iduser,
                    'type' => 'follow'
                );
                NotifModel::AddNotifS($notif);
                //
	    		echo 'success';	
	    	} else {
	    		echo 'failed';
	    	}
    	}
    }
    
    function remove(Request $request)
    {
    	$id = Auth::id();
    	$iduser = $request['iduser'];

    	//save to follow
    	$rest = FollowModel::Remove($iduser, $id);
    	if ($rest) {
    		echo 'success';	
    	} else {
    		echo 'failed';
    	}
    }

    function check(Request $request)
    {
    	$id = Auth::id();
    	$iduser = $request['iduser'];

    	//save to follow
    	$rest = FollowModel::Check($iduser, $id);
    	if ($rest) {
    		echo 'success';	
    	} else {
    		echo 'failed';
    	}
    }
}
