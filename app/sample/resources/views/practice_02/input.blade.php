@extends('layouts.app')

@section('title', 'アプリケーション基礎')

@section('content')
    <div>
        <p>文字を入力してください。</p>
        <form method="POST" action="/practice_02">
            {{--laravelではPOST送信にトークンの設定が必要--}}
            {{ csrf_field() }}
            <input type="text" name="text">
            <input type="submit" value="実行">
        </form>
    </div>
@endsection
