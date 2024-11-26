@extends('layouts.login')

@section('content')

<!-- プロフィール編集画面 -->
<div class="container">
  <div class="update">

    <form action="/profile/update"enctype="multipart/form-data"method="POST">
          @csrf
      <div class="update-line">
        @if(Auth::user()->images === 'icon1.png')
          <img src="{{ asset('images/icon1.png') }}"width="50"height="50" class="update-icon">
          @else
          <img src="{{ asset('storage/images/'.Auth::user()->images) }}"
          class="update-icon" width="50"height="50">
          @endif

        <div class="update-form">
            <input type="hidden" name="id" value="{{Auth::user()->id}}">
            <div class="update-block"><!--ユーザー名-->
              <label for="name">ユーザー名</label>
              <input type="text" name="username" value="{{Auth::user()->username}}" class="update-size">
              @if ($errors->has('username'))
                <span class="edit-form">
                  {{$errors->first('username')}}
                </span>
                @endif
            </div>
            <div class="update-block"><!--メールアドレス-->
              <label for="mail">メールアドレス</label>
              <input type="email" name="mail" value="{{Auth::user()->mail}}" class="update-size">
              @if ($errors->has('mail'))
                <span class="edit-form">
                  {{$errors->first('mail')}}
                </span>
                @endif
            </div>
            <div class="update-block"><!--パスワード-->
              <label for="pass">パスワード</label>
              <input type="password" name="password" value="" class="update-size">
                @if ($errors->has('password'))
                <span class="edit-form">
                  {{$errors->first('password')}}
                </span>
                @endif
            </div>
            <div class="update-block"><!--パスワード確認用-->
              <label for="name">パスワード確認</label>
              <input type="password" name="password_confirmation" value="" class="update-size">
            </div>
            <div class="update-block"><!--自己紹介文-->
              <label for="name">自己紹介</label>
              <input type="text" name="bio" value="{{Auth::user()->bio}}" class="update-size">
              @if ($errors->has('bio'))
                <span class="edit-form">
                  {{$errors->first('bio')}}
                </span>
                @endif
            </div>
            <div class="update-block"><!--アイコン画像アップロード-->
              <label for="name" class="user-images">アイコン画像</label>
              <label for="image" class="file-choice">ファイルを選択</label>
              <input type="file" name="images" id="image" class="update-size1">
            </div>
          </div>
      </div>
            <button type="submit" class="btn btn-danger1">更新</button>
    </form>
  </div>
</div>


@endsection
