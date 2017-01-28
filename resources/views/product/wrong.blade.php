@extends('layout.layout')
@section('content')
    <div class="col-md-offset-3 col-md-5"  style="text-align: center;">
        <h4 style="margin-top: 200px; text-align: center; margin-bottom: 50px;">Вы не можете отредактировать это объявления так как не являетесь его автором</h4>
        <a href="{{route('product.index')}}">Вернуться на главную</a>
    </div>

@endsection