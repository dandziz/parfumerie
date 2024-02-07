<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parfumerie</title>
    <link rel="stylesheet" href="{{asset('css/global.css')}}">
</head>
<body>
    <main>
        <img src="{{asset('images/email.png')}}" alt="Email" class="email-img">
        <h5>{{__('messages.emailVerified')}}</h5>
        <p class="p-14 text-gray text-center">
            Tài khoản của bạn đã được xác thực, truy cập hệ thống để đăng nhập hoặc <a href="{{env('URL_CLIENT').'login'}}">nhấn vào đây.</a>
        </p>
    </main>
</body>
</html>
