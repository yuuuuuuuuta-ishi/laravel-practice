@extends('layouts.app')

@section('title', '総合課題')

@section('content')

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
    @if (@$responseData['errorMessage'])
        <p class="error">{{ $responseData['errorMessage'] }}</p>
    @endif
    <div class="content">
        <h2 class="title_002">
            社員情報詳細
        </h2>
        <div>
            @if (empty($responseData['user']) === false)
                <div class="textBox_2">
                    <form method="POST" action="/practice_08/user/update">
                        {{ csrf_field() }}
                        <div class="child">
                            <label>社員コード</label>
                            <p class="disable_edit">{{ $responseData['user']['code'] }} </p>
                            <input type="hidden" name="code" value={{ $responseData['user']['code'] }}>
                        </div>
                        <div class="parent">
                            <div class="child">
                                <label>社員名</label>
                                <input type="text" name="name" value="{{ $responseData['user']['name'] }}">
                                @error('name')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="child">
                                <label>年齢</label>
                                <input type="number" name="age" max="100"
                                    min="18"value={{ $responseData['user']['age'] }}>
                                @error('age')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="parent">
                            <div class="child">
                                <label>支店</label>
                                <input type="text" name="branch" list="branch"
                                    value={{ $responseData['user']['branch'] }}>
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
                                <input type="text" name="department" list="department"
                                    value={{ $responseData['user']['department'] }}>
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
                                <input type="text" name="post"
                                    list="post"value={{ $responseData['user']['post'] }}>
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
                                <input type="text" name="entryDate" value={{ $responseData['user']['entry_date'] }}
                                    pattern="\d\d\d\d-\d\d-\d\d">
                                @error('entryDate')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="botton">
                            <input type="submit" value="更新" class="botton_item">
                    </form>
                    <form method="POST" action="/practice_08/user/delete">
                        {{ csrf_field() }}
                        <input type="hidden" name="code" value={{ $responseData['user']['code'] }}>
                        <input type="submit" value="削除" onclick='return confirm("本当に削除しますか？")' class="botton_item">
                    </form>
                </div>
            @endif
        </div>
    </div>
    </div>
@endsection
