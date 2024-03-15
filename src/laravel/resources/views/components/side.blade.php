<div class='side'>
    <ul>
        <ul>
            <li><a href="/">home</a></li>
            <li><a href="/practice_02">Blade基礎</a></li>
            <li><a href="/practice_03">Controller基礎</a></li>
            <li><a href="/practice_04">MVC基礎</a></li>
            <li><a href="/practice_05">リクエスト基礎</a></li>
            <li><a href="/practice_06">総合課題①</a></li>
            <li><a href="/practice_07">総合課題②</a></li>
            <li><a href="/practice_08">追加要件</a></li>
            <ul class="nav__wrapper">
            </ul>
            {{-- <li class="nav__item">オブジェクト指向</li> --}}
        </ul>
    </ul>
</div>

@push('css')
    <style>
        .side {
            width: 20%;
            text-align: left;
            color: #000000;
            height: 100vw;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.22);
        }

        ul {
            margin: 5px;
            padding: 0;
            background: white;
            color: #5f6f81;
            list-style: none;
            text-transform: none;
            font-weight: 300;
            /* font-family: 'Lato', Arial, sans-serif; */
            line-height: 60px;
        }

        li {
            list-style-type: none;
            border-bottom: 1px solid #c6d0da;
            text-align: left;
            font-size: 18px;
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



        @media (min-width: 600px) {
            .nav__wrapper {
                display: flex;
            }
        }

        @media (max-width: 599px) {
            .nav__wrapper {
                position: absolute;
                top: 100%;
                right: 0;
                left: 0;
                z-index: -1;
                visibility: hidden;
                opacity: 0;
                transform: translateY(-100%);
                transition: transform 0.3s ease-out, opacity 0.3s ease-out;
            }

            .nav__wrapper.active {
                visibility: visible;
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
