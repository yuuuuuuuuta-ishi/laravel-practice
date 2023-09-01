<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">



<head>
    <!-- cssの呼び出し-->
    <link rel="stylesheet" href="{{ asset('/css/list.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/textBox.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/message.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/layout.css') }}">
    <script type="module" src="{{ asset('/js/app.js') }}"></script>

    <title>WEBアプリケーション開発課題</title>
</head>

<body>

    <!-- Header Start -->
    <header class="site-header">
        <div class="wrapper site-header__wrapper">
            <h1 class="title_001">
                @yield('title')
            </h1>
        </div>
    </header>
    <div class="container">
        <div class="side">
            <ul>
                <li class="nav__item"><a href="/">home</a></li>
                <li class="nav__item"><a href="/practice_02">Blade基礎</a></li>
                <li class="nav__item"><a href="/practice_03">Controller基礎</a></li>
                <li class="nav__item"><a href="/practice_04">MVC基礎</a></li>
                <li class="nav__item"><a href="/practice_05">リクエスト基礎</a></li>
                <li class="nav__item"><a href="/practice_06">総合課題①</a></li>
                <li class="nav__item"><a href="/practice_07">総合課題②</a></li>
                <ul class="nav__wrapper">
                </ul>
                <li class="nav__item"><a href="/practice_08">追加要件</a></li>
                <li class="nav__item">オブジェクト指向</li>
                <!--<li class="nav__item"><a href="/practice_09">オブジェクト指向</a></li>-->
            </ul>
        </div>
        <div class="main">
            @yield('content')
        </div>
    </div>
</body>
<footer>
    <!-- 省略 -->
</footer>

</html>

<!doctype html>
