@extends('layouts.login')

@section('content')

<div class="container">

  <div class="container1">
    <p class="page-header">
      @if($user->images === 'icon1.png')
      <img src="{{ asset('images/icon1.png') }}"width="50"height="50" class="icon1">
      @else
      <img src="{{ asset('storage/images/'.$user->images) }}
      "width="50"height="50" class="icon1">
      @endif
    </p>
    {!! Form::open(['url' => 'post/create','class' =>'form-post']) !!}

    <div class="form-group">
      {!! Form::textarea('newPost', null,  ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください。']) !!}
      @if ($errors->has('upPost'))
                <span class="post-form">
                  {{$errors->first('upPost')}}
                </span>
                @endif
    </div>
  </div>

  <div class="post_btn">
    <button type="submit"class="post">
      <img src="images/post.png"width="40"height="40">
    </button>
  </div>
</div>

{!! Form::close() !!}

<hr class="plain">
<table class="table table-hover">
  @foreach ($posts as $post)
  <ul>
    <li class="post-block">
      <div class="post-line">
        @if($post->user->images === 'icon1.png')
        <img src="{{ asset('images/icon1.png') }}" width="50"height="50">
        @else
        <img src="{{ asset('storage/images/'.$post->user->images) }}"width="50"height="50">
        @endif

        <div class="post-index">
            <div class="post-top">
                <div>{{ $post->user->username }}</div><!-- 名前 -->
                <div>{{ substr($post->created_at,0,16) }}</div><!-- 登録日 -->
            </div>
            <div class="post-last">
                <div>{!! nl2br(e($post->post)) !!}</div><!-- 投稿内容 -->

                <!-- 編集 -->
                <div class="post-btn">
                  @if(($post->user_id ==Auth::user()->id))
                    <a class="js-modal-open" href="" post="{{$post->post }}" post_id="{{$post->id }}">
                    <img class="Update" src="./images/edit.png"  alt="編集">
                    </a>

                  <!-- 削除 -->
                    <a class="delete_btn" href="/post/{{ $post->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
                    <img class="Trash" src="./images/trash.png" alt="toggle">
                    </a>
                    @endif
                </div>
            </div>
        </div>
      </div>
    </li>
  </ul>

  @endforeach

  <!-- モーダル -->
  <div class="modal js-modal">
    <div class="modal_bg js-modal-close"></div>
    <div class="modal_content">
      <form action="/post/update" method="POST">
          <textarea name="upPost" class="modal_post"></textarea>
          <input type="hidden" name="id" class="modal_id" value="">
        <button type="submit"class="edit"><img src="images/edit.png" width="30" height="30"></button>
        <a class="js-modal-close" href=""></a>
        {{ csrf_field() }}
      </form>
    </div>
  </div>


</table>
@endsection
