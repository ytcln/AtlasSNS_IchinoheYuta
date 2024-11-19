@extends('layouts.login')

@section('content')

<!-- フォローされている人のアイコン一覧 -->
<div class="follow_line">
    <h1 class="list">フォロワーリスト</h1>
    <div class="follower_icon">
        @foreach ($followers as $follow)
        <ul>
            <li>
                <div class="follower_icon">
                    <a href="/otherProfile/{{$follow->id}}">
                    <img src="{{ asset('storage/'.$follow->images) }}" alt="フォロワーアイコン"class="icon-space"width="50"height="50">
                    </a>
                </div>
            </li>
        </ul>
        @endforeach
    </div>
</div>

@foreach($posts as $post)

<li class="follow-post"">
    <figure class="post_icon"></figure>
    <div class="post-content">
        <img src="{{ asset('storage/'.$post->user->images) }}  "width="50"height="50">

        <div class="follow-lines">
            <div class="follow-content">
                <div>{{ $post->user->username }}</div>
                <div>{{ substr($post->created_at,0,16) }}</div>
            </div>
                <div>{!! nl2br(e($post->post)) !!}</div>
        </div>
    </div>
</li>

@endforeach
@endsection
