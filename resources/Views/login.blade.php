<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
</head>
<body>
    <h1>登入畫面</h1>
    <form action='/login' method='POST'>
        {{-- {{csrf_field()}} --}}
        @csrf
        帳號：<input type='text' name='account'><br/>
        密碼：<input type='password' name='password'><br/>
        <button type='submit'>登入</button>
    </form>
</body>
</html>