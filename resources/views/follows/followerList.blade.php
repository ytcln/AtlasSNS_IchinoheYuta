@extends('layouts.login')

@section('content')

<!-- フォローされている人のアイコン一覧 -->
<div class="side1">
    <h1>フォロワーリスト</h1>
    <div class="follower_icon">
        @foreach ($followers as $follow)
        <ul>
            <li>
                <div class="follower_icon">
                    <a href="/otherProfile/{{$follow->id}}">
                    <img src="{{ asset('storage/'.$follow->images) }}" alt="フォロワーアイコン">
                    </a>
                </div>
            </li>
        </ul>
        @endforeach
    </div>
    </div>

@foreach($posts as $post)

<hr class="plain">
<li class="post">
    <figure class="post_icon"></figure>
    <div class="post_content">
        <div>{{ $post->user->username }}</div>
        <div>{{ $post->created_at }}</div>
        <div>{{ $post->post }}</div>
        <div><img src="{{ asset('storage/'.$post->user->images) }}" ></div>
    </div>
</li>

@endforeach
@endsection
