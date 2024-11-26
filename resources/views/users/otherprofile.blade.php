@extends('layouts.login')

@section('content')

<!-- プロフィール編集画面 -->

@if($users->images === 'icon1.png')
  <img src="{{ asset('images/icon1.png') }}"width="50"height="50" class="icon-image">
  @else
  <img src="{{ asset('storage/images/'.$users->images) }}" class="icon-image"width="50"height="50">
@endif

<div>
  <div class="other-line">
    <div class="other-post">
      <p class="other-font">ユーザー名 {{$users->username}}</p>
      <p class="other-font1">自己紹介 {{$users->bio}}</p>
      @if(!(Auth::user()==$users))
      @if(auth()->user()->isFollowing($users->id))
      <li class="un_follow_btn">
        <button type="submit" class="btn btn-other">
          <a href="{{route('unfollow',$users->id)}}" class="btn-text">フォロー解除</a></button>
      </li>
        @else
        <li class="follow_btn">
          <form action="{{route('follow',$users->id)}}" method="post" class="info1">
            @csrf
            <button type="submit" class="btn btn-info">フォローする</button>
          </form>
        </li>
      @endif
      @endif
    </div>
  </div>
</div>

  @foreach($posts as $post)

<li class="follow-post">
      <div class="post-content">
        @if($users->images === 'icon1.png')
        <img src="{{ asset('images/icon1.png') }}"width="50"height="50" class="icon-image1">
        @else
        <img src="{{ asset('storage/images/'.$users->images) }}" class="icon-image1"width="50"height="50">
        @endif

          <div class="follow-lines">
            <div class="follow-content">
              <div>{{$post->user->username}}</div>
              <div>{{ substr($post->created_at,0,16) }}</div>
            </div>
              <div>{!! nl2br(e($post->post)) !!}</div>
          </div>
      </div>
</li>

@endforeach
@endsection
