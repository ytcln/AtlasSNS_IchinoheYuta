@extends('layouts.login')

@section('content')

<!-- プロフィール編集画面 -->
<div class="container">
  <div class="update">
    {!! Form::open(['url' => '/profile/update']) !!}
    @csrf
    {{ Form::hidden('id',Auth::user()->id) }}
    <img class="update-icon" src="images/icon1.png">
    <div class="update-form">
      <div class="update-block"><!--ユーザー名-->
        <label for="name">user name</label>
        <input type="text" name="username" value="{{Auth::user()->username}}">
      </div>
      <div class="update-block"><!--メールアドレス-->
        <label for="mail">mail address</label>
        <input type="email" name="mail" value="{{Auth::user()->mail}}">
      </div>
      <div class="update-block"><!--パスワード-->
        <label for="pass">password</label>
        <input type="password" name="password" value="">
      </div>
      <div class="update-block"><!--パスワード確認用-->
        <label for="name">password comfirm</label>
        <input type="password" name="password_confirmation" value="">
      </div>
      <div class="update-block"><!--自己紹介文-->
        <label for="name">bio</label>
        <input type="text" name="bio" value="{{Auth::user()->bio}}">
      </div>
      <div class="update-block"><!--アイコン画像アップロード-->
        <label for="name">icon image</label>
        <input type="file" name="images">
      </div>
      <input type="submit" class="btn btn-danger">
      {{Form::token()}}
      {{!! Form::close() !!}}
    </div>
   </div>
 </div>


@endsection
