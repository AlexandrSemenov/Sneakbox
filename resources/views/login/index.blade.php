@extends('layout.layout')
@section('title', 'Sneakbox - маркетплейс кроссовок')
@section('description', 'Sneakbox - Первый маркетплейс в Украине по продаже и покупке кроссовок')

@section('content')
    <div class="row">

        <div class="col-md-offset-4 col-md-4" style="margin-top: 100px">
            <h4 style="text-align: center">Для авторизации введите свои данные</h4>

            @if($loginError = Session::get('message'))
                <p class="bg-warning" style="padding: 15px">{{$loginError}}</p>
            @endif

            <form action="{{route('login')}}" method="post">
                <div class="form-group {{ $errors->first('email')? 'has-error' : '' }}">
                    <input class="form-control" type="text" name="email" placeholder="Ваш email">
                    @if ($errors->first('email'))
                        <span class="help-block">{{  $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->first('password')? 'has-error' : '' }}">
                    <input class="form-control" type="password" name="password" placeholder="Ваш пароль">
                    @if ($errors->first('password'))
                        <span class="help-block">{{  $errors->first('password') }}</span>
                    @endif
                </div>
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input class="btn btn-primary btn-block" type="submit" value="войти">
            </form>
            <div style="margin-top: 20px;"><a href="{{ route('password.reset') }}">Забыли пароль?</a></div>
        </div>
    </div>
@endsection