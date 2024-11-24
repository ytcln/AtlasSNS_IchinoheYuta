<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />

    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
            <h1 class="logo"><a href="{{url('/top')}}">
                <img src="/images/atlas.png" class="top"></a>
            </h1>
            <div class=side_user>
                <div id="accordion" class="accordion-container">
                    <p class="btn-menu">{{ Auth::user()->username}} さん</p>
                    <div class="accordion accordion-title">
                        <img src="{{ asset('storage/images/'.Auth::user()->images) }}"width="50"height="50"class="accordion-image">
                    </div>

                        <div class="menu-list">
                            <div class="menu-btn">
                                <ul class="menu">
                                    <li class="menu-top"><a href="/top" class="menu-hover">HOME</a></li>
                                    <li class="menu-top"><a href="/profile"class="menu-hover">プロフィール編集</a></li>
                                    <li class="menu-top"><a href="/logout"class="menu-hover">ログアウト</a></li>
                                </ul>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </header>

    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm" class="confirm">
                <p class="side1">{{Auth::user()->username}}さんの</p>
                <div>
                    <div class="side">
                    <p>フォロー数</p>
                    <p>{{Auth::user()->follows()->count()}}名</p>
                    </div>
                </div>
                <p class="btn-side"><a href="/follow-list" class="btn1">フォローリスト</a>
                </p>
                <div>
                    <div class="side">
                    <p>フォロワー数</p>
                    <p>{{Auth::user()->followers()->count()}}名</p>
                    </div>
                </div>
                <p class="btn-side"><a href="/follower-list" class="btn1">フォロワーリスト</a>
                </p>
            </div>
            <hr class="hr1">
            <p class="btn-u"><a href="/search" class="btn1">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/script.js')}}"></script>
</body>
</html>
