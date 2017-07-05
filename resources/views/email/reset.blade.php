<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h3>Добрый день, {{$user->name}}</h3>

<div>
    <h3>Чтобы изменить пароль перейдите по ссылке</h3>
    <p>Изменить пароль: <a href="{{ $url }}password-reset-form/?token={{ $user->reset_token }}">{{ $url }}password-reset-form/?token={{ $user->reset_token }}</a></p>
</div>

</body>
</html>