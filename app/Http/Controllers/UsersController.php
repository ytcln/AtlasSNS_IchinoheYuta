<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\User;
use App\Post;
use Student;
use Hash;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    //認証済みのユーザー取得
    public function profile()
    {
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

    // public function update(Request $request)
    // {
    //     $user = Auth::user();
    //     //画像登録　アイコンはシンボリックリンク使用
    //     $image = $request->file('images')->store('public/storage');

    //     $user->update([
    //         'username' => $request->input('username'),
    //         'mail' => $request->input('mail'),
    //         'password' => bcrypt($request->input('password')),
    //         'bio' => $request->input('bio'),
    //         'images' => basename($image),

    //     ]);
    //     //プロフィールバリデーション
    //     $validator = Validator::make($request->all(),[
    //         'username' => 'required|string|min:2|max:12',
    //         'mail' => 'required|string|min:5|max:40|email',
    //         'password' => 'alpha_num|required|string|min:8|max:20|confirmed',
    //         'password_confirmation' => 'alpha_num|required|string|min:8|max:20|same:password',
    //         'bio' => 'max:150',
    //         'images' => 'image|mimes:jpg,png,bmp,gif,svg',
    //     ]);
    //     //$id = $request->input('id');
    //     return redirect('/top');
    // }

    //プロフィール編集機能
    public function updateProfile(Request $request)
    {
        //dd($request);

         //プロフィールバリデーション
         $request->validate([
              'username' => 'required|string|min:2|max:12',
              'mail' => 'required|string|email|min:5|max:40',
              'password' => 'alpha_num|required|string|min:8|max:20|confirmed',
              'bio' => 'max:150',
              'images' => 'nullable|image|mimes:jpg,png,bmp,gif,svg',
          ],[
                'username.required' => 'ユーザー名を入力してください',
                'mail.required' => 'メールを入力してください',
                'password.required' => '英数字8文字から20文字までです',
                'bio' => '150文字以内です'
            ]);

          $id = $request->input('id');
          //dd($id);

          //画像登録

          if($request->file('images') != null){
            $images = $request->file('images')->getClientOriginalName();
            $icon = $request->file('images')->storeAs('public/images', $images);
            DB::table('users')
            ->where('id',$id)
            ->update([
                'images' => basename($images),
            ]);
          }

        $username = $request->input('username');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $bio = $request->input('bio');

            User::where('id', $id)->update([
            'username' => $username,
            'mail' => $mail,
            'password' => Hash::make($password),
            'bio' => $bio,
        ]);

        return redirect('/top');
    }

    //他ユーザーのプロフィール
    public function otherProfile($id){

    $users = User::where('id',$id)->first();
    $posts = Post::with('user')->where('user_id', $id)->get();

    return  view('users.otherProfile',['id'=>$id])->with('users',$users)->with('posts',$posts);
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

//他ユーザーのフォロー機能
    public function follow($id)
    {
        $user = Auth::user();
        $follower = auth()->user();//フォローしているか
        $is_following = $follower->isFollowing($id);
        if(!$is_following){ //もしフォローしていなければ
              $follower->follow($id);//フォローする
        }
        return back();
    }

//他ユーザーのフォロー解除
    public function unfollow($id)
    {
        $user = Auth::user();
        $follower = auth()->user();//フォローしているのか
        $is_following = $follower->isFollowing($id);
        if($is_following){//もしフォローしていれば
            $follower->unfollow($id);//フォロー解除する
        }
        return back();
    }
}
