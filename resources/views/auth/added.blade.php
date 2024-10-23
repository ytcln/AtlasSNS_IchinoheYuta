@extends('layouts.logout')

@section('content')

<div id="clear">
  <div class="text1">
  <div class="text-center2">
  <p class="center3">{{ session('username') }}さん</p>
  <p class="center6">ようこそ! AtlasSNSへ</p>
  <p class="center4">ユーザー登録が完了いたしました</p>
  <p class="center7">早速ログインをしてみましょう!</p>

  <p class="center5"><input type="button" onclick="history.back(-2)" value="ログイン画面へ" class="red"></p>
</div>
</div>
</div>

@endsection
