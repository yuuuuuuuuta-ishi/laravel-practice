@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">ログイン</div>
                <div class="card-body">
                    @if ($message ?? '')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @endif
                    <form id="loginForm" action="{{ route('login.process') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="user_id">ユーザーID:</label>
                            <input type="text" class="form-control" id="user_id" name="user_id">
                        </div>
                        <div class="form-group">
                            <label for="password">パスワード:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group text-center mt-3">
                            <button id="loginButton" type="submit" class="btn btn-outline-primary btn-lg" disabled
                                data-bs-toggle="button">ログイン</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var user_id_input = document.getElementById('user_id');
            var password_input = document.getElementById('password');
            var login_button = document.getElementById('loginButton');

            user_id_input.addEventListener('input', toggleLoginButton);
            password_input.addEventListener('input', toggleLoginButton);

            function toggleLoginButton() {
                if (user_id_input.value.trim() !== '' && password_input.value.trim() !== '') {
                    login_button.removeAttribute('disabled');
                } else {
                    login_button.setAttribute('disabled', 'disabled');
                }
            }
        });
    </script>
@endsection
