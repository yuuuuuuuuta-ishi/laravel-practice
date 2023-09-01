@extends('layouts.app')

@section('title', '総合課題')

@section('content')

    <div class="content">

        @if (@$responseData['message'])
            <p class="success">{{ $responseData['message'] }}</p>
        @endif
        @if (@$responseData['errorMessage'])
            <p class="error">{{ $responseData['errorMessage'] }}</p>
        @endif
        <button class="url_button">
            <input type="button"
                onclick="location.href='{{ route('practice_08.work.get', ['employeeCode' => session('code')]) }}'"
                value="勤怠一覧・登録">
        </button>
        <button class="url_button">
            <input type="button" onclick="location.href='/practice_08/user'"" value="社員情報一覧">
        </button>
    </div>

@endsection
