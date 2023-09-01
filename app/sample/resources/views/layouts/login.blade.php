<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">



<head>
<!-- cssの呼び出し-->
<link rel="stylesheet" href="{{ asset('/css/list.css')  }}" >
<link rel="stylesheet" href="{{ asset('/css/textBox.css')  }}" >
<link rel="stylesheet" href="{{ asset('/css/header.css')  }}" >
<link rel="stylesheet" href="{{ asset('/css/message.css')  }}" >
<link rel="stylesheet" href="{{ asset('/css/table.css')  }}" >
<link rel="stylesheet" href="{{ asset('/css/layout.css')  }}" >

    <title>WEBアプリケーション開発課題</title>
</head>
        <!-- Header Start -->
        <header class="site-header">
            <div class="wrapper site-header__wrapper">
                <h1 class="title_001">
                    @yield('title')
                </h1>
            </div>
        </header>
<body>

    <div class="container">
        @yield('content')
    </div>
</body>

</html>
