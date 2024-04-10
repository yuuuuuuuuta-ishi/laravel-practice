@extends('layouts.app')

@section('title', 'ようこそ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="alert alert-success" role="alert">
                <h1>ようこそ、{{ $username }} さん！</h1>
            </div>
        </div>
    </div>

@endsection
