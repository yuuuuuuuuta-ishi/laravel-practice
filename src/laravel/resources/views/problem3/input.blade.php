<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>problem3-input</title>
    </head>
    <body>
        <h1>Controller基礎</h1>
        <hr>
        <h2>生年月日を入力してください。</h2>
        <form action="/problem3/output" method="post">
            @csrf
            <p>
                生年月日<br>
                <input type="date" name="birthday" max="9999-12-31">
            </P>
            <p>
                <input type="submit" value="実行">
            </p>
        </form>
    </body>
</html>
