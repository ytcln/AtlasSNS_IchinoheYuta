<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\support\Facades\Auth;

use App\User;
use App\Follow;
use App\Post;

class FollowsController extends Controller
{
    //auth認証
    public function __construct()
    {
        $this->middleware('auth');
    }


    //フォロー・フォロワー数カウント
public function following(){
   $followings =Follow::where('following_id', Auth::id())->get();
    return view('auth.login' , compact('followings'));
}
//フォロー数＝following_idにある自分のidの数

public function followed(){
    $followers =Follow::where('followed_id', Auth::id())->get();
    return view('auth.login' , compact('followers'));
}

//フォローリスト表示機能
    public function followList(){
        $follows = Auth::user()->follows()->get();
        $following_id = Auth::user()->follows()->pluck('followed_id');
        $posts =Post::with('user')->whereIn('user_id',$following_id)->latest()->get();
        return view('follows.followList', ['follows' => $follows,'posts' => $posts]);

        //return view('follows.followList' ,['follow_user' =>$follow_user]);
    }

    //public function followpostlist(){
        //$followpost =Post::query()->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))->latest()->get();

        //return view('follows.followList')->with([
       //     'followpost' => $followpost,
        //]);

        //画像アイコン
        //$images = DB::table('users')->get();
       // $images = auth()->user()->follows()->get();

        //return view('follows.followList', compact('posts'))->with(['images'=>$images]);
    //}

//フォロワーリスト
    public function followerList(){
        $user = Auth::user();
        $follow_user = $user -> follows() ->get();
//followUsers→followsに変更
        return view('follows.followerList' ,['follow_user'=>$follow_user]);
    }

//フォロー数
    public function follows(){
        return $this->belongsToMany(User::class,'follows','following_id','followed_id');
}

//フォロワー数
    public function followers(){
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
}

//フォロー機能
public function follow($id){

    $follower = Auth::user();
    $is_following = $follower->isFollowing($id);//フォローしているか
    if($is_following) {//フォローしていなければフォローする
        $follower->follow($id);
    }
        return back();

}
//フォロー解除機能
public function unfollow(User $user){
    $follower = Auth::user();
    $is_following =$follower->isFollowing($user->id);//フォローしているか
    if($is_following) {//フォローしていればフォロー解除する}
        $follower->unfollow($user->id);
    }
        return back();
}

//フォローリスト表示機能
//public function followList()
//{
    //$follows = Auth::User()->follows()->get();
    //ログインユーザーがフォローしている人を表示する
    //$following_id = Auth::user()->follows()->pluck('followed_id');
    //ログインユーザーが誰をフォローしているのかfollowing_idを取得(pluck)
    //$posts = Post::with('user')->whereIn
    //('user_id', $following_id)->latest()->get();
    //Postモデル(postsテーブル)からuserテーブルのuser_idと＄following_idが同じ投稿を昇順で取得
    //return view('follows.followList',
    //['follows' => $follows,'posts' => $posts]);
//}

}
