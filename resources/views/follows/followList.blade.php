@extends('layouts.login')

@section('content')

<!-- フォローしている人のアイコン一覧 -->
<div class="side1">
    <h1>フォローリスト</h1>
    <div class="follow_icon">
        @foreach ($follows as $follow)
        <ul>
            <li>
                <div class="follow_icon">
                    <a href="/otherProfile/{{$follow->id}}">
                    <img src="{{ asset('storage/'.$follow->images) }}" alt="フォローアイコン">
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
        <p class="side2">{{ $post->created_at }}</p>
        <p class="side3">
        <img src="{{ asset('storage/'.$post->user->images) }}">
        {{ $post->user->username }}</p>
        <p>{{ $post->post }}</p>
    </div>
</li>

  @endforeach
@endsection
