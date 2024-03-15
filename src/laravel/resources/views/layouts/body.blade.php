<!doctype html>

<body>
    <div class="container">
            {{-- <x-side> </x-side> --}}
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

@stack('css')

<style>
    html,
    body {
        height: 100%;
    }

    .container {
        flex-grow: 1;
        box-sizing: border-box;
        display: flex;
        width: 100%;
    }

    .main {
        width: 80%;
        height: 100%;
    }

</style>

</html>
