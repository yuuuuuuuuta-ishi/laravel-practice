
@extends('layouts.app')

@section('title', 'Controller基礎')

@section('content')
    <div class="content">
        <h2 class="title_002">生年月日を入力してください。</h2>
        <form method="POST" action="/practice_03">
            {{ csrf_field() }}
            <div class="textBox">
                <label>生年月日</label>
                <input type="date" name="birthday"  max="2025-02-05">
            </div>
            <p>
                <input type="submit" value="実行">
            </p>
        </form>
    </div>
@endsection
