@extends('layouts.login')

@section('content')

<div class="container">

<p class="page-header"><img src="images/icon1.png"width="50"height="50"></p>
{!! Form::open(['url' => 'post/create']) !!}

<div class="form-group">
  {!! Form::input('text', 'newPost', null,  ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください。']) !!}
</div>

<button type="submit"></button><img src="images/post.png"width="100"height="100">

{!! Form::close() !!}

<table class="table table-hover">
@foreach ($posts as $post)
<tr>
  <td>{{ $post->user->user_id }}</td>
  <td>{{ $post->user->username }}</td>
  <td>{{ $post->post }}</td><!-- 投稿内容 -->
  <td>{{ $post->created_at }}</td><!-- 登録日 -->
  <td>{{ $post->update_at }}</td>
  <!-- 編集 -->
  @if(($post->user_id ==Auth::user()->id))
  <td><div class="new-contents">
    <a class="js-modal-open" href="" post="{{$post->post }}" post_id="{{$post->id }}">
      <img src="./images/edit.png"  alt="編集">
    </a></div>
  </td>


<!-- 削除 -->
  <td><a class="delete_btn" href="/post/{{ $post->id }}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
  <img src="./images/trash.png" alt="削除">
  </a>
</td>
</tr>
@endif

@endforeach
</table>

<!-- モーダル -->
<div class="modal js-modal">
  <div class="modal_bg js-modal-close"></div>
  <div class="modal_content">
    <form action="/post/update" method="POST">
      <textarea name="upPost" class="modal_post"></textarea>
      <input type="hidden" name="id" class="modal_id" value="">
      <input type="submit" value="更新">
      {{ csrf_field() }}
    </form>
    <a class="js-modal-close" href="">閉じる</a>
  </div>
</div>

</div>
@endsection
