@extends('layouts.login')

@section('content')

<!-- プロフィール編集画面 -->
<img src="{{ asset('storage/user-images/'. Auth::user()->images) }}" class="icon-image">


{!! Form::open(['url' => ['/profile/{id}/update'],'method' => 'post']) !!}
{!! Form::hidden('id',$auth->id) !!}

<p>{{ Form::label('username','user name')}}</p>
<p>{{ Form::text('username',$auth->username,['class' =>'input'])}}</p>

<p>{{ Form::label('mail','mail')}}</p>
<p>{{ Form::text('mail',$auth->mail,['class' =>'input'])}}</p>

<p>{{ Form::label('password','password')}}</p>
<p>{{ Form::label('password_confirm','password confirm')}}</p>

<p>{{ Form::label('bio','bio')}}</p>
<p>{{ Form::text('bio',$auth->bio,['class' =>'input'])}}</p>

<p>{{ Form::label('image','image')}}</p>
<p>{{ Form::file('image',['class' =>'input' ,'id'=>'images'])}}</p>

<p>{{ Form::submit('更新') }}</p>

{{!!Form::close()!!}}

@endsection
