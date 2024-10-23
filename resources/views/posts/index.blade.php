@extends('layouts.login')

@section('content')

<div class="container">

  <div class="container1">
    <p class="page-header">
    <img src="{{ asset('storage/'.$user->images) }}"width="50"height="50" class="icon1">
    </p>
    {!! Form::open(['url' => 'post/create']) !!}

    <div class="form-group">
      {!! Form::input('text', 'newPost', null,  ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください。']) !!}
    </div>
  </div>

  <div class="post_btn">
    <button type="submit">
    <img src="images/post.png"width="40"height="40">
    </button>
  </div>
</div>

{!! Form::close() !!}

<hr class="plain">
<table class="table table-hover">
  @foreach ($posts as $post)
  <tr>
    <td class="icon">
      <img src="{{ asset('storage/'.$post->user->images) }}"width="50"height="50" class="icon2">
    </td>
    <td>{{ $post->user->user_id }}</td>
    <td>{{ $post->user->username }}</td><!-- 名前 -->
    <td>{{ $post->post }}</td><!-- 投稿内容 -->
    <td>{{ $post->created_at }}</td><!-- 登録日 -->
    <td>{{ $post->update_at }}</td><!-- 投稿時刻 -->


    <!-- 編集 -->
    @if(($post->user_id ==Auth::user()->id))
    <td><div class="new-contents">
      <a class="js-modal-open" href="" post="{{$post->post }}" post_id="{{$post->id }}">
      <img class="Update" src="./images/edit.png"  alt="編集">
      </a></div>
    </td>

    <!-- 削除 -->
    <td><div class="new-contents">
      <a class="delete_btn" href="/post/{{ $post->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
    <img class="Trash" src="./images/trash-h.png" alt="削除" >
    </a></div>
    </td>
  </tr>


  <!-- モーダル -->
  <div class="modal js-modal">
    <div class="modal_bg js-modal-close"></div>
      <div class="modal_content">
        <form action="/post/update" method="POST">
            <textarea name="upPost" class="modal_post"></textarea>
            <input type="hidden" name="id" class="modal_id" value="">
          <button type="submit"><img src="images/edit.png" width="30" height="30"></button>
          <a class="js-modal-close" href="">閉じる</a>
          {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>

  @endif

  @endforeach
</table>

@endsection
