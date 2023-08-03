<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">



<head>
<!-- cssの呼び出し-->
<link rel="stylesheet" href="{{ asset('/css/list.css')  }}" >
<link rel="stylesheet" href="{{ asset('/css/textBox.css')  }}" >
<link rel="stylesheet" href="{{ asset('/css/header.css')  }}" >
<link rel="stylesheet" href="{{ asset('/css/message.css')  }}" >

    <title>WEBアプリケーション開発課題</title>
</head>

<body>
    <h1 class="title_001">
        @yield('title')
    </h1>


    <div class="container">
        @yield('content')
    </div>
</body>

</html>
