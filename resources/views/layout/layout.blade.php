<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <link rel="stylesheet" href="{{URL::to('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/slick/slick.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ elixir("assets/css/style.css") }}">
    <script src="{{URL::to('assets/js/jquery-1.11.2.min.js')}}"></script>
</head>
<body>
@include('tpl.header')

<div class="container">
    @yield('content')
</div>

@include('tpl.footer')

<script src="{{URL::to('assets/js/vue.min.js')}}"></script>
<script src="{{ URL::to('assets/slick/slick.min.js') }}"></script>
<script src="{{URL::to('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{ URL::to('assets/js/app.js') }}"></script>
</body>
</html>