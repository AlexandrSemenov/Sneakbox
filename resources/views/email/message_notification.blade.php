<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h3>Добрый день, {{ $user->name }}</h3>

<div>
    <h4>У вас новое сообщение</h4>
    <p>Чтобы открыть переписку перейдите по ссылке <a href="{{ App::make('url')->to('/') }}/messages/show/{{ $mes->conversation_id }}">{{ App::make('url')->to('/') }}/messages/show/{{ $mes->conversation_id }}</a></p>
</div>

</body>
</html>