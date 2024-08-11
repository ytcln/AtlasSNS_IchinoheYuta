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
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
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

//Route::get('/search','UsersController@index');

Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');

//新規登録
Route::get('/users','LoginController@users');

//新規登録用　view
//Route::get('/register', 'Auth\RegisterController@registerView');

//ログアウト機能
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

//検索
//Route::get('/search', 'UsersController@search')-> name('posts.index');
//Route::get('users/{user_id}', 'UsersController@show')->name('users.show');
Route::get('/users/search', 'UsersController@searching')-> name('posts.index');

//});
//ここまでアクセス制限OK 5/26

///投稿用メソッド移動用ルート
Route::post('/tweet', 'PostsController@tweet')->name('post.tweet');;

//投稿内容更新
Route::post('/update', 'PostsController@update');
Route::get('/update', 'PostsController@update');

//投稿の一覧表示
Route::get('/posts','PostsController@index');

//投稿機能
Route::post('/post/create','PostsController@create');
//Route::get('/post','PostsController@create');

//投稿編集
Route::post('/update/{id}','PostsController@update')->name('posts.update');

//削除
Route::post('/post/{id}/delete', 'PostsController@delete');
Route::get('/post/{id}/delete', 'PostsController@delete');

//ログインユーザーのプロフィール表示
Route::get('/profile', 'UsersController@profile')->name('profile.index');

//ログインユーザーのプロフィール更新
Route::post('/update','UsersController@update')->name('profile.update');

//フォローリスト
Route::get('/follow-list', 'FollowsController@followList');
//Route::get('/follow-list', 'FollowsController@followpostlist');

//フォロワーリスト
Route::get('/follower-list', 'FollowsController@followerList');

//フォロー機能
Route::post('/user/{id}/follow', 'FollowsController@follow');

//フォロー解除機能
Route::get('/user/{id}/unfollow', 'FollowsController@unfollow');

//フォロー機能
Route::post('/users/{user}/follow', 'UsersController@follow')->name('follow');

//フォロ-リストの表示
Route::post('/FollowList','PostsController@view');

//ユーザー検索機能
Route::get('/search', 'UsersController@search');

//The GET method is not supported for this route. Supported methods: POSTエラー解消
Route::post('/search', 'UsersController@search');

Route::get('/user/index', 'UsersController@index')->name('users.index');

//Route::get('/top','FollowsController@follows');
//Route::post('/top','FollowsController@follows');
//Route::get('/top','FollowsController@followers');
//Route::post('/top','FollowsController@followers');

});
