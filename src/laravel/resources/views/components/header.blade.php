<!-- resources/views/components/header.blade.php -->

<header class="site-header">
    <title>
        WEBアプリケーション開発課題
    </title>
    <div class="wrapper site-header__wrapper">
        <h1 class="title_001">
            {{$title}}
        </h1>
    </div>
</header>

@push('css')
    <style>
        .site-header {
            position: relative;
            /* border-bottom: solid 5px #5d627b; */
            background: #f4f4f4;
            padding: 0 0 8px;
        }

        .site-header__wrapper {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        @media (min-width: 600px) {
            .site-header__wrapper {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-top: 0;
                padding-bottom: 0;
            }
        }

    </style>
@endpush
