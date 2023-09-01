@extends('layouts.app')

@section('title', '総合課題')

@section('content')

    @if (@$responseData['message'])
        <p class="success">{{ $responseData['message'] }}</p>
    @endif
    @if (@$responseData['errorMessage'])
        <p class="error">{{ $responseData['errorMessage'] }}</p>
    @endif
    <div class="content">
        <h2 class="title_002">
            社員情報新規登録
        </h2>
        <div>
            <form method="POST" action="/practice_08/user/create">
                {{ csrf_field() }}
                <div class="textBox_2">
                    <div class="parent">
                        <div class="child">
                            <label>社員名</label>
                            <input type="text" name="name">
                            @error('name')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="child">
                            <label>年齢</label>
                            <input type="number" name="age" max="100" min="18">
                            @error('age')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="parent">
                        <div class="child">
                            <label>支店</label>
                            <input type="list" autocomplete="off" list="branch" name="branch">
                            <datalist id="branch">
                                <option value="本社"></option>
                                <option value="東北支店"></option>
                                <option value="東海支店"></option>
                                <option value="近畿支店"></option>
                                <option value="中国支店"></option>
                                <option value="四国支店"></option>
                                <option value="九州支店"></option>

                            </datalist>
                            @error('branch')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="child">
                            <label>部署</label>
                            <input type="list" autocomplete="off" list="department" name="department">
                            <datalist id="department">
                                <option value="総務部"></option>
                                <option value="経理部"></option>
                                <option value="人事部"></option>
                                <option value="営業部"></option>
                                <option value="開発部"></option>
                            </datalist>
                            @error('department')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="parent">
                        <div class="child">
                            <div>役職</div>
                            <input type="list" autocomplete="off" list="post" name="post">
                            <datalist id="post">
                                <option value="係長"></option>
                                <option value="主任"></option>
                                <option value="一般社員"></option>
                            </datalist>
                            @error('post')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="child">
                            <label>入社日</label>
                            <input type="date" name="entryDate">
                            @error('entryDate')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="botton">
                        <input type="submit" value="登録" class="botton_item">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
