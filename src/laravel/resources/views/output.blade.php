
@component('components.header')
    @slot('title')
    教育課題3(controller基礎)
    @endslot
@endcomponent
@extends('layouts.body')
@section('content')
<div class="content">
        <h2 class="title_002">
            「{{$message}}」
        </h2>
</div>
@endsection
