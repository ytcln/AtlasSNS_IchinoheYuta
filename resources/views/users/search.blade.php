@extends('layouts.login')

@section('content')

{!! Form::open(['url' => '/search']) !!}
<!-- 検索窓　-->
<div>
  <form action="{{ url('/users/search') }}" method="GET">
    <input type="keyword" name="users" placeholder="ユーザー名">
    <button type="submit" class="btn btn-success pull-right"><img src="/images/search.png"></button>
  </form>
</div>

<!-- 検索ワードの表示　-->
@if (!empty($keyword))
<p>検索ワード:{{ $keyword }}</p>
@endif
{!! Form::close() !!}

<!-- //*保存されているレコードを一覧表示　*// -->
<div class="container-list">

  <table class='table table-hover'>
     @foreach ($users as $users)
     <!-- 自分以外のユーザーの表示　-->
    @if (!($user->username == $users->username))
    <tr>
      <td>{{ $users->username }}</td>
      <td><img src="{{ $users->images }}" alt="ユーザーアイコン"></td>
    </tr>
    @endif
    @endforeach
   </table>

  </div>

<!-- 登録ユーザー表示 -->
<div class="user_display">
  <ul>
    <li class="user_block">
      <!-- ユーザー情報ひとまとめ -->
      <div class="user_contents">
        @foreach ($users as $user)
        <ul>
          <!--登録者アイコン -->
          <li class="register_icon">
            <img src="{{'images/'. $user->images}}" alt="登録者アイコン">
          </li>
          <!-- 登録者名 -->
          <li class="center_user_content">{{ $user->username }}</li>
          <!-- フォロー、フォロー解除ボタン -->
          @if (auth()->user()->isFollowing($user->id))
          <li class="unfollow_btn">
            <button type="submit" class="btn btn-danger">
              <a href="/user/{{$user->id}}/unfollow" class="btn-text">フォロー解除</a></button>
          </li>
          @else
          <li class="follow_btn">
            <form action="/user/{{$user->id}}/follow" method="post">
              @csrf
              <button type="submit" class="btn btn-info">フォローする</button>
            </form>
          </li>
          @endif
        </ul>
        @endforeach
      </div>
    </li>
  </li>
  </ul>
</div>

@endsection
