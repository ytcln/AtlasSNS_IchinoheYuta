<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
     return view('welcome');
});
//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//アクセス制限
Route::get('/login', 'Auth\LoginController@login')-> name('login');

//ログイン中のページ
Route::group(['middleware' => 'auth'], function() {

Route::get('/top','PostsController@index');


Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@index');

Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');

//新規登録
Route::get('/users','LoginController@users');

//新規登録用　view
//Route::get('/register', 'Auth\RegisterController@registerView');

//ログアウト機能
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

//検索
Route::get('/search', 'UsersController@search')-> name('posts.index');
Route::get('users/{user_id}', 'UsersController@show')->name('users.show');
Route::get('/search', 'UsersController@searching')-> name('posts.index');

//});
//ここまでアクセス制限OK 5/26

///投稿用メソッド移動用ルート
Route::post('/tweet', 'PostsController@tweet')->name('post.tweet');;

//投稿内容更新
Route::post('/update-form', 'PostsController@update');
Route::get('/update-form', 'PostsController@update');

//投稿の一覧表示
Route::get('/posts','PostsController@index');

//投稿用ルーティング
Route::post('/create','PostsController@create');
Route::get('/create','PostsController@create');

//削除
Route::post('/post/{id}/delete', 'PostsController@delete');
Route::get('/post/{id}/delete', 'PostsController@delete');

//プロフィール
Route::get('/profile/{id}/view', 'UsersController@profile')->name('profile.index');

//フォロワーリスト
Route::get('/follow-list', 'FollowsController@followList');
Route::get('/follower-list', 'FollowsController@followerList');

//フォロー機能
Route::post('/user/{id}/follow', 'FollowsController@follow');

//フォロー解除機能
Route::get('/user/{id}/unfollow', 'FollowsController@unfollow');

//フォローのルーティング
Route::post('/users/{user}/follow', 'UserController@follow')->name('follow');

//ユーザー検索機能
Route::post('/search', 'UserController@search');
});
