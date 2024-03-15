
@component('components.header')
    @slot('title')
    教育課題4(MVC基礎)
    @endslot
@endcomponent
@extends('layouts.app')

@section('content')
<div class="content">
    <h2 class="title_002">
        「{{$message}}」
    </h2>
</div>
@endsection
