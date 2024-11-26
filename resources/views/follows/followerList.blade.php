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
                        @if($follow->images === 'icon1.png')
                        <img src="{{ asset('images/icon1.png') }}"width="50"height="50"class="icon-space">
                        @else
                        <img src="{{ asset('storage/images/'.$follow->images) }}" alt="フォロワーアイコン"class="icon-space"width="50"height="50">
                        @endif
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
        <a href="/otherProfile/{{$post->user_id}}">
            @if($post->user->images === 'icon1.png')
            <img src="{{ asset('images/icon1.png') }}"width="50"height="50">
            @else
            <img src="{{ asset('storage/images/'.$post->user->images) }}  "width="50"height="50">
            @endif
        </a>

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
