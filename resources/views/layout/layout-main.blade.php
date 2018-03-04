<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <link rel="stylesheet" href="{{URL::to('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ elixir("assets/css/style.css") }}">
</head>
<body class="main">

@include('tpl.header-main')

<div class="container">
    @yield('content')
</div>

@include('tpl.footer')

<script src="{{URL::to('assets/js/jquery-1.11.2.min.js')}}"></script>
</body>
</html>