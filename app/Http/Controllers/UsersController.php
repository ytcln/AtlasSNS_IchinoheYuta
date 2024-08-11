<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use APP\Post;
use Student;

class UsersController extends Controller
{
    //認証済みのユーザー取得
    public function profile(){
        $auth = Auth::user();
        return view('users.profile',['auth' => $auth]);
    }

    public function show($id)
    {
        // 特定のユーザーをデータベースから取得
        $user = User::findOrFail($id);

        // ユーザー情報をビューに渡す
        return view('profile.show', compact('user'));
    }

    public function bio(array $data)
    {
        //bio（自己紹介文）を作成
        return User::create([
            'bio' => $data['bio'],
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        //画像登録　アイコンはシンボリックリンク使用
        $image = $request->file('images')->store('public/storage');

        $user->update([
            'username' => $request->input('username'),
            'mail' => $request->input('mail'),
            'password' => bcrypt($request->input('password')),
            'bio' => $request->input('bio'),
            'images' => basename($image),

        ]);
        $validator = Validator::make($request->all(),[
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|min:5|max:40|email',
            'password' => 'alpha_num|required|string|min:8|max:20|confirmed',
            'password_confirmation' => 'alpha_num|required|string|min:8|max:20|same:password',
            'bio' => 'max:150',
            'images' => 'image|mimes:jpg,png,bmp,gif,svg',
        ]);
        //$id = $request->input('id');
        return redirect('top');
    }

    //検索結果を表示させる
    public function search(Request $request)
    {
        $users = User::get();
        $keyword = $request->input('keyword');
      return view('users.search')->with(['users' => $users, 'keyword' =>$keyword]);
    }
//ユーザー検索の処理を実装する
public function getIndex(Request $rq)
{
    //キーワード受け取り
    $keyword = $rq->input('search');

    //クエリ生成
    $query = \App\Student::query();

    //もしキーワードがあったら
    if(!empty($keyword))
    {
        $query->where('username','like','%'.$keyword.'%');
    }

    //全件取得　ページネーション
    $students =$query->orderBy('id','desc')->paginate(5);
    return view('student.list')->with('students',$students)->with('search',$search);
}

//検索機能の実行
    public function searching(Request $request){

    $user = Auth::user();

//検索フォームで入力された値を取得する
$keyword = $request->input('users');
//dd($keyword);

//データベースに問い合わせ
if(!empty($keyword)){
    $query = User::query();
    $query->where('username','LIKE', "%{$keyword}%");
    $users = $query->get();
    return view('/users/search',compact('users','user','keyword'));
}
    else{
        $users = User::get();
        return view('/users/search',['users'=>$users],['user'=>$user],['keyword'=>$keyword]);
    }


        return view('users.search');
    }
    //
    public function users()
    {
        $users = User::get();
        return view('web.php',['users'=>$top]);
    }

//フォロー機能
    public function follow(User $user){
        $user = Auth::user();
        $follower = auth()->user();//フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following){ //もしフォローしていなければ
        $follower->follow($user->id);//フォローする
        }
        return back();
    }

//フォロー解除
    public function unfollow(User $user){
        $user = Auth::user();
        $follower = auth()->user();//フォローしているのか
        $is_following = $follower->isFollowing($user->id);
        if($is_following){//もしフォローしていれば
            $follower->unfollow($user->id);//フォロー解除する
        }
        return back();
    }
}
