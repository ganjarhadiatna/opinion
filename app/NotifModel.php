<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NotifModel extends Model
{
    function scopeCekNotifStory($query, $iduser)
    {
        return DB::table('notifications')
        ->where('notifications.iduser', $iduser)
        ->where('notifications.status','=','unread')
        ->count();
    }

    function scopeUpdateNotifS($query, $iduser)
    {
        return DB::table('notifications')
        ->where('iduser', $iduser)
        ->where('status', '=' ,'unread')
        ->update(array('status' => 'read'));
    }
    function scopeAddNotifS($query, $data)
    {
        return DB::table('notifications')
        ->insert($data);
    }

    function scopeGetNotifS($query, $id, $limit)
    {
        return DB::table('notifications')
        ->select(
            'notifications.idnotifications',
            'notifications.idstory',
            'notifications.idbookmark',
            'notifications.idcomment',
            'notifications.idlove',
            'notifications.id',
            'notifications.iduser',
            'notifications.type',
            'notifications.created',
            'users.foto',
            'users.username',
            'users.name',
            'comment.description as val_comment',
            'story.description as val_story'
        )
        ->where('notifications.iduser', $id)
        ->leftJoin('users','users.id','=','notifications.id')
        ->leftJoin('comment','comment.idcomment','=','notifications.idcomment')
        ->leftJoin('story','story.idstory','=','notifications.idstory')
        ->orderBy('notifications.idnotifications', 'desc')
        ->paginate($limit);
    }
}
