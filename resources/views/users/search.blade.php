@extends('layouts.login')

@section('content')


<!-- 検索窓　-->
<div class="search1">
  <form action="{{ url('/users/search') }}" method="GET" class="search2">
      <input type="keyword" name="users" placeholder="ユーザー名" class="holder">
      <button type="submit" class="btn btn-success">
        <img src="/images/search.png" class="user">
      </button>
  </form>

  <!-- 検索ワードの表示　-->
  @if (!empty($keyword))
  <div class="search-word">
  <td>検索ワード : {{ $keyword }}</td>
  </div>
  @else
  <td></td>
  @endif
</div>


<!-- 登録ユーザー表示 -->
<hr class="plain1">
<div class="user_display">
  <ul>
    <li class="user_block">
      <!-- ユーザー情報ひとまとめ -->
      <div class="user_contents">
        @foreach ($users as $user)
        @if (!(auth()->user()->username == $user->username))
        <ul>
          <!--登録者アイコン -->
          <div class="search">
            <li class="register_icon">
              @if($user->images === 'icon1.png')
                <img src="{{ asset('images/icon1.png') }}"width="50"height="50" class="search-icon">
                @else
                <img src="{{'storage/images/'. $user->images}}" alt="登録者アイコン"width="50"height="50"class="search-icon">
                @endif
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
          </div>
          @endif
        </ul>
        @endif
        @endforeach
      </div>
    </li>
  </li>
  </ul>
</div>

@endsection
