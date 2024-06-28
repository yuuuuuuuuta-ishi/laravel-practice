<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>problem4-input</title>
    </head>
    <body>
        <h1>MVC基礎</h1>
        <hr>
        <h2>コードとパスワードを入力してください。</h2>
        <form action="/problem4/output" method="post">
            @csrf
            <p>
                コード<br>
                <input type="text" name="code" placeholder="code">
            </P>
            <p>
                パスワード<br>
                <input type="password" name="password" placeholder="password">
            </p>
            <p>
                <input type="submit" value="ログイン">
            </p>
        </form>
    </body>
</html>
