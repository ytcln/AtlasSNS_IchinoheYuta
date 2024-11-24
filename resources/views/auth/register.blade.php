@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}

<div class="text">
  <div class="text-center1">
<p class="center2">新規ユーザー登録</p>

<div class="home">
  <p>{{ Form::label('ユーザー名') }}</p>
  <p class="top">
    {{ Form::text('username',null,['class' => 'input']) }}
    @if ($errors->has('username'))
    <span class="login-form">
      {{$errors->first('username')}}
    </span>
    @endif
  </p>
</div>

<div class="home">
  <p>{{ Form::label('メールアドレス') }}</p>
    <p class="top">
      {{ Form::text('mail',null,['class' => 'input']) }}
      @if ($errors->has('mail'))
      <span class="login-form">
        {{$errors->first('mail')}}
      </span>
      @endif
    </p>
</div>

<div class="home">
  <p>{{ Form::label('パスワード') }}</p>
    <p class="top">
    {{ Form::password('password',null,['class' => 'input']) }}
    @if ($errors->has('password'))
    <span class="login-form">
      {{$errors->first('password')}}
    </span>
    @endif
  </p>
</div>

<div class="home">
  <p>{{ Form::label('パスワード確認') }}</p>
  <p class="top">{{ Form::password('password_confirmation',null,['class' => 'input']) }}</p>
</div>

<p class="right"><input type="submit" value=新規登録 class="red"></p>

<p class="under"><a href="/login">ログイン画面に戻る</a></p>
</div>
</div>

{!! Form::close() !!}


@endsection
