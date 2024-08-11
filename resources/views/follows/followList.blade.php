@extends('layouts.login')

@section('content')


<!-- フォローしている人のアイコン一覧 -->
    <h1>フォローリスト</h1>
    <div class="follow_icon">
        @foreach ($follows as $follow)
        <ul>
            <li>
                <div class="follow_icon"><img src="{{ asset('storage/'.$follow->images) }}" alt="フォローアイコン"></div>
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
