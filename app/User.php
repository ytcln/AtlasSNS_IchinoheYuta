<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'following_id', 'follows_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //フォローしている数
    public function isFollowing(Int $user_id){
        return(boolean)$this->follows()->where
        ('followed_id',$user_id)->first(['follows.id']);
    }
    //フォローされてる数
    public function isFollowed(Int $user_id){
        return(boolean)$this->followers()->where
        ('following_id',$user_id)->first(['follows._id']);
    }
    //ユーザーがフォローしている人数の取得（フォロー）
    public function follows()//belongsToManyは多対多を使用
    {
        return $this->belongsToMany(User::class,'follows',
        'following_id','followed_id')->whileTimestamps();
    }
    //ユーザーをフォローしている人数の取得（フォロワー）
    public function followers()
    {
        return $this->belongsToMany(User::class,'followers',
        'following_id','followed_id')->whileTimestamps();
    }
    //フォロー解除
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }
    //フォロー
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    //「１対多」の「多」側->メソッド名は複数形でhasManyを使う
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
