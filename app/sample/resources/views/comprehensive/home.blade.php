@extends('layouts.app')

@section('title', 'MVC基礎')

@section('content')
    <div>
        @if (@session('errors'))
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (@$responseData['message'])
            <p class="success">{{ $responseData['message'] }}</p>
        @endif
        <h2 class="title_002">
            勤怠登録
        </h2>
        <div>
            <!--<h3 class="title_002">勤怠の情報を入力してください</h3> -->
            <form method="POST" action="/comprehensive/work">
                {{ csrf_field() }}
                <div class="textBox">
                    <label>出社時刻</label>
                    <input type="datetime-local" name="startTime" placeholder="出社時刻" step="900">
                    @error('startTime')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <label>退社時刻</label>
                    <input type="datetime-local" name="endTime" placeholder="退社時刻" step="900">
                    @error('endTime')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="sentenseBox">
                    <label>作業内容</label>
                    <input type="text" name="details">
                    @error('details')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <p>
                    <input type="hidden" name="employeeCode" value={{ $responseData['employeeCode'] }}>
                    <input type="submit" value="登録">
                </p>
            </form>
        </div>
    </div>
@endsection
