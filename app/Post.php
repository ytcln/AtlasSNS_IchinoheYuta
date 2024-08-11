<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    //リレーション定義を追加
    //「1対多」の「１」側→メソッド名は単数形belongsToを使う
    protected $fillable = ['post','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
