@extends('layouts.login')

@section('content')

<!-- プロフィール編集画面 -->

<img src="{{ asset('storage/'.$users->images) }}" class="icon-image">

<div>
  <div>
  <p>ユーザー名 {{$users->username}}</p>
  <p>自己紹介 {{$users->bio}}</p>
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
  <hr class="plain">
  <div class="block">
    @foreach($posts as $post)
   <tr class="post-contents">
    <img src="{{ asset('storage/'.$users->images) }}" class="icon-image"width="60"height="60">

   <td>{{$post->user->username}}</td>
   <td>{{$post->post}}</td>
   <td>{{$post->created_at}}</td>
   </tr>
   @endforeach
   </div>
</div>

@endsection
