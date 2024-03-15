@component('components.header')
    @slot('title')
        教育課題2(blade基礎)
    @endslot
@endcomponent
@extends('layouts.body')
@section('content')
    <div class="content">
        <p>入力された文字は</p>
        <p>
            「{{ $text }}」
        </p>
        <p>です。</p>
    </div>
@endsection
