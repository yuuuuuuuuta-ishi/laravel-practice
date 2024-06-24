<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>problem1_input</title>
    </head>
    <body>
        <h1>アプリケーション基礎</h1>
        <p>文字を入力してください。</p>
        <form action="problem1_output" method="post">
            @csrf
            <input type="text" name="message">
            <input type="submit" value="実行">
        </form>
    </body>
</html>