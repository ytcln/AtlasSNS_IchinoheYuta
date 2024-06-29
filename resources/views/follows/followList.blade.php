@extends('layouts.login')

@section('content')

<!-- フォローしている人のアイコン一覧 -->
<div class"">
  <!-- タイトル -->
  <h2>Follow List</h2>
  @foreach ($follows as $follow)
  <ul>
    <li>
      <!-- アイコンひとまとめ -->
      <div class="follow_icon"><img src="{{ asset('storage/'.$follow->images) }}
      alt="フォローアイコン"></div>

    </li>
  </ul>
  @endforeach

</div>
@endsection
