<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'following_id', 'followed_id'
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
        ('following_id',$user_id)->first(['follows.id']);
    }
    //フォロー機能の実装
    //フォロー数
    public function follows()//belongsToManyは多対多を使用
    {
        return $this->belongsToMany(User::class,'follows',
        'following_id','followed_id')->withTimestamps();
    }
    //フォロワー数
    public function followers()
    {
        return $this->belongsToMany(User::class,'follows',
        'followed_id','following_id')->withTimestamps();
    }
    //フォロー解除
    public function unfollow($id)
    {
        return $this->follows()->detach($id);
    }
    //フォローする
    public function follow($id)
    {
        return $this->follows()->attach($id);
    }

    //「１対多」の「多」側->メソッド名は複数形でhasManyを使う
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
