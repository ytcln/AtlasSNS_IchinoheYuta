@extends('layouts.login')

@section('content')

<!-- フォローされている人のアイコン一覧 -->
    <h1>フォロワーリスト</h1>
    <div class="follower_icon">
        @foreach ($follow_user as $follow)
        <ul>
            <li>
                <div class="follower_icon"><img src="{{ asset('storage/'.$follow->images) }}" alt="フォロワーアイコン"></div>
            </li>
        </ul>
        @endforeach
    </div>

@foreach($posts as $post)

<li class="post">
    <figure class="post_icon"></figure>
    <div class="post_content">
        <div>{{ $post->user->username }}</div>
        <div>{{ $post->created_at }}</div>
        <div>{{ $post->post }}</div>
    </div>
</li>

@endforeach
@endsection
