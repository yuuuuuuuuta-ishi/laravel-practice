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
            社員一覧
        </h2>
        <div class="link_1">
            <a href="/practice_08/user/create">担当者の新規登録</a>
        </div>
        <div>
            <table class="table_1">
                <tr>
                    <th>社員コード</th>
                    <th>名前</th>
                    <th>役職</th>
                    <th>部署</th>
                    @if(session('isAdmin') === TRUE)
                    <th></th>
                    @endif
                </tr>
                @if (empty($responseData['users']) === false)
                    @foreach ($responseData['users'] as $user)
                        <tr>
                            <td>{{ $user['code'] }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['department'] }}</td>
                            <td>{{ $user['post'] }}</td>
                            @if(session('isAdmin') === TRUE)
                            <td>
                                <form method="GET" action="/practice_08/user/get">
                                <input type="hidden" name="code" value={{ $user['code']  }}>
                                <input type="submit" value="詳細・編集">
                                </form>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
            </table>
            {{ $responseData['users']->links() }}

        </div>
    </div>
@endsection
