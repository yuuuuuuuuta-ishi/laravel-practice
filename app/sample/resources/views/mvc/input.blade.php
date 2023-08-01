@extends('layouts.app')

@section('title', 'MVC基礎')

@section('content')
    <div>
        <h2 class="title_002">コードとパスワードを入力してください。</h2>
        <form method="POST" action="/mvc">
            {{ csrf_field() }}
            <div class="textBox">
                <label>コード</label>
                <input type="text" name="code" placeholder="code">
            </div>
            <div class="textBox">
                <label>パスワード</label>
                <input type="password" name="password" placeholder="password">
            </div>
            <p>
                <input type="submit" value="ログイン">
            </p>
        </form>
    </div>
@endsection


