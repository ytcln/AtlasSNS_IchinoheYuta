@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/login']) !!}

<div class="text">
  <div class="text-center">
<p class="center2">AtlasSNSへようこそ</p>

<div class="home">
  <p class>{{ Form::label('メールアドレス') }}</p>
  <p class="top">{{ Form::text('mail',null,['class' => 'input']) }}</p>
</div>
<div class="home">
  <p class></p>{{ Form::label('パスワード') }}</p>
  <p class="top">{{ Form::password('password',['class' => 'input']) }}</p>
</div>

<p class="right"><input type="submit" value=ログイン class="red"></p>

<p class="under"><a href="/register">新規ユーザーの方はこちら</a></p>
</div>
</div>

{!! Form::close() !!}

@endsection
