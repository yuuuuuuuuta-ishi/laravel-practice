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
                    <form method="POST" action="/user/update">
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
                            </div>
                            <div class="child">
                                <label>年齢</label>
                                <input type="number" name="age" max="100"
                                    min="18"value={{ $responseData['user']['age'] }}>
                            </div>
                        </div>
                        <div class="parent">
                            <div class="child">
                                <label>支店</label>
                                <input type="text" name="branch" value={{ $responseData['user']['branch'] }}>
                            </div>
                            <div class="child">
                                <label>部署</label>
                                <input type="text" name="department" value={{ $responseData['user']['department'] }}>
                            </div>
                        </div>
                        <div class="parent">
                            <div class="child">
                                <div>役職</div>
                                <input type="text" name="post" value={{ $responseData['user']['post'] }}>
                            </div>
                            <div class="child">
                                <label>入社日</label>
                                <input type="text" name="entryDate" value={{ $responseData['user']['entry_date'] }}
                                    pattern="\d\d\d\d-\d\d-\d\d">
                            </div>
                        </div>
                        <div class="botton">
                            <input type="submit" value="更新" class="botton_item">
                    </form>
                    <form method="POST" action="/user/delete">
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
