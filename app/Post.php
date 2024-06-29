<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //リレーション定義を追加
    //「1対多」の「１」側→メソッド名は単数形belongsToを使う
    public function user(){
        return $this->belongsTo('App\User');
    }
}
