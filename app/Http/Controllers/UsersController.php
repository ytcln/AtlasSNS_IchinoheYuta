<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Student;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }

    //検索結果を表示させる
    public function search(Request $request)
    {
        dd($request);
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
    if(!empty($search))
    {
        $query->orwhere('name','like','%'.$search.'%');
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
dump($keyword);

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
    //下記追記
    public function users()
    {
        $users = User::get();
        return view('web.php',['users'=>$top]);
    }

}
