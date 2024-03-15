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
    .content {
            margin: 20px;
            padding: 1em;
            color: #5d627b;
            background: white;
            border-top: solid 5px #5d627b;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.22);
            width: 90%;
            height: 100%;
        }
    .main {
        width: 80%;
        height: 100%;
    }

</style>

</html>
