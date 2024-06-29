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

        public function index()
        {
            $user = Auth::user(); //ログイン認証しているユーザーの取得
            $username = Auth::user()->username;
             return view('posts.index'); //現在認証しているユーザーの取得

             $list = Post::get();
               return view('posts.index',['list'=>$list]);
            }
            public function posts()
            {
               $posts = Post::get(); //Postモデル（postsテーブル）からレコード情報を取得
               return view('posts.index',['posts'=>$posts]);
            }


  //投稿を表示する
  public function create(Request $request)
  {
   $post = $request->input('newPost');
   DB::table('posts')->insert([
      'post' => $post,
      'user_id' => Auth::user()->id
   ]);
   return redirect('top');

    //return view('post/create');
  }

  //投稿機能
  public function store(Request $request)
  {
     $post = new Post;
     $post->id = $request->session()->get('id');
     $post->user_id = $request->user_id;
     $post->post = $request->post;
     $post->save();
     return redirect()->route('post.create');
  }

  public function tweet(Request $request)
  {
   $post = $request->input('newPost');
   $user = Auth::user()->id;
   Post::create([
      'post' => $post,
      'user_id' => $user,
   ]);
   return redirect('/top');
  }
}
