<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h3>Добрый день, {{$email['name']}}</h3>

<div>
    <h3>Ваше объявление будет удалено через 10 дней</h3>
    <p>Если вы не хотите чтобы ваше объявление было удалено, перейдите по ссылке <a href="http://sneak-box.dev/product/updated/{{$email['slug']}}?token={{$email['token']}}">http://sneak-box.dev/product/updated/{{$email['slug']}}?token={{$email['token']}}</a> </p>
</div>

</body>
</html>