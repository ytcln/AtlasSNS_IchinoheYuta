<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //Auth認証
    public function _construct()
    {
      $this->middleware('auth');
    }

    //トップページ
        public function index()
        {
            $user = Auth::user(); //ログイン認証しているユーザーの取得
            $username = Auth::user()->username;
            $posts = Post::get();
            // return view('posts.index'); //現在認証しているユーザーの取得
            $following_id =auth()->user()->follows()->pluck('followed_id');

            $posts = Post::orderBy('created_at','desc')->with('user')->whereIn('user_id',$following_id)->orWhere('user_id',$user->id)->get();
            return view('posts.index',['posts'=>$posts,'user'=>$user]);
            }


        //public function posts()
            //{
               //$posts = Post::get(); //Postモデル（postsテーブル）からレコード情報を取得
               //return view('posts.index',['posts'=>$posts]);
            //}


  //投稿を表示する
  public function create(Request $request)
  {
   //$id = Auth::id();
   $request->validate([
    'newPost' => 'required|unique:posts,post|min:1|max:150',
   ]);
   $user_id =Auth::id();
   $post = $request->input('newPost');
   Post::create([
            'user_id' => $user_id,
            'post' => $post,
   ]);
   return redirect('/top');

    return view('post/create');
  }

  //投稿を編集する
  public function update(Request $request)
  {
    $id = $request->input('id');
    $up_post = $request->input('upPost');
    $user_id = Auth::id();

    Post::where('id', $id)->update([
        'post' => $up_post,
    ]);

    return redirect('/top');
  }

  //投稿を削除する
  public function delete($id)
  {
    Post::where('id',$id)->delete();
    return redirect('/top');
  }

  //投稿機能
  public function store(Request $request)
  {
    //$this->validate($request,
    //['content' =>'required|min:1|max:150']);

     $post = new Post;
     $post->id = $request->session()->get('id');
     $post->user_id = $request->user_id;
     $post->post = $request->input('content');//postカラムにデータを保存
     $post->save();
     return redirect()->route('post.create');
  }

  public function tweet(Request $request)
  {
    //ログインしているユーザーのID
   $post = $request->input('newPost');
   $user = Auth::user()->id;
   Post::create([
      'post' => $post,
      'user_id' => $user,
   ]);
   return redirect('/top');
  }

  public function show(){
  // Postモデル経由でpostsテーブルのレコードを取得
  $posts = Post::get();
  return view('yyyy', compact('posts'));
}

public function view()
{
   $following_id = Auth::user->follows()->pluck('followed_id');
   $posts = post::with('user')->whereIN('id', $following_id)->get();
   return view('follows.followList', compact('posts'));
}

public function post(Request $request)
{
    if($request->isMethod('post')){

        $data = $request->input('newPost');

        $user_id = Auth::id();

        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect('/top')
                ->withErrors($validator)
                ->withInput();
        }

        $this->create($data);

        \DB::table('posts')
        ->insert([
            'post' => $post,
            'user_id' => $user_id
        ]);

        return redirect('/top');
    }
   }

}
