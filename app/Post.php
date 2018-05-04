<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Post extends Model
{
//    public function member() {
//        $member_id = $this->member_id;
//
//        $memberObject = Member::find($member_id);
//        $this->member = $memberObject;
//        return $this->member;
//    }
    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function member() {
        return $this->belongsTo('App\Member');
    }

}
