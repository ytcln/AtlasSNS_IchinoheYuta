<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;
use Auth;
use Post;

class FollowsController extends Controller
{
    //

    //フォロー・フォロワー数カウント
public function following(){
    $followings =Follow::where('following_id', Auth::id())->get();
    return view('auth.login' , compact('followings'));
}
//フォロー数＝following_idにある自分のidの数

public function followed(){
    $followeds =Follow::where('followed_id', Auth::id())->get();
    return view('auth.login' , compact('followeds'));
}


    //public function followList(){//フォローリスト
    //    return view('follows.followList');
   // }
    public function followerList(){//フォロワーリスト
        return view('follows.followerList');
    }

    public function followers()
{
return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
}

//フォロー機能
public function follow(User $user){
    $follower = Auth::user();
    $is_following = $follower->isFollowing($user->id);//フォローしているか
    if($is_following) {//フォローしていなければフォローする
        $follower->follow($user->id);
        return back();

    }
}
//フォロー解除機能
public function unfollow(User $user){
    $follower = Auth::user();
    $is_following =$follower->isFollowing($user->id);//フォローしているか
    if($is_following) {//フォローしていればフォロー解除する}
        $follower->unfollow($user->id);
        return back();

    }
}

//フォローリスト表示機能
public function followList()
{
    $follows = Auth::User()->follows()->get();
    //ログインユーザーがフォローしている人を表示する
    $following_id = Auth::user()->follows()->pluck('followed_id');
    //ログインユーザーが誰をフォローしているのかfollowing_idを取得(pluck)
    $posts = Post::with('user')->whereIn
    ('user_id', $following_id)->latest()->get();
    //Postモデル(postsテーブル)からuserテーブルのuser_idと＄following_idが同じ投稿を昇順で取得
    return view('follows.followList',
    ['follows' => $follows,'posts' => $posts]);
}
}
