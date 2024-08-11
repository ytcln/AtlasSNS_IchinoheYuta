<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //中間テーブルでフォロー機能
    protected $fillable = ['following_id','followed_id'];

    public function getFollowCount($user_id){
        return $this->where('following_id',$user_id)->count();

    }
    public function getFollowerCount($user_id){
        return $this->where('followed_id',$user_id)->count();

    }
}
