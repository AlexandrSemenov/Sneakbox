<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sneakbox</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{URL::to('assets/slick/slick.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ elixir("assets/css/style.css") }}">
</head>
<body>
@include('tpl.header')
<div class="container">
    @yield('content')
</div>

{{--<script src="http://code.jquery.com/jquery-3.1.1.slim.js" integrity="sha256-5i/mQ300M779N2OVDrl16lbohwXNUdzL/R2aVUXyXWA=" crossorigin="anonymous"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>--}}
<script src="{{URL::to('assets/js/jquery-1.11.2.min.js')}}"></script>
<script src="{{URL::to('assets/js/vue.min.js')}}"></script>
<script src="{{ URL::to('assets/slick/slick.min.js') }}"></script>
<script src="{{URL::to('assets/js/jquery-ui.min.js')}}"></script>
<script src="{{ URL::to('assets/js/app.js') }}"></script>
</body>
</html>