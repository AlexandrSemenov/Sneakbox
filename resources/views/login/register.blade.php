@extends('layout.layout')
@section('content')
    <div class="row">
        <div class="col-md-offset-4 col-md-4" style="margin-top: 100px">
            <h4 style="text-align: center">Для регистрации заполниет форму</h4>

            <form action="{{route('login.register.user')}}" method="post">
                <div class="form-group {{ $errors->first('name')? 'has-error' : '' }}">
                    <input class="form-control" type="text" name="name" value="{{Request::old('name')}}" placeholder="Имя пользователя">
                    @if ($errors->first('name'))
                        <span class="help-block">{{  $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->first('email')? 'has-error' : '' }}">
                    <input class="form-control" type="text" name="email" value="{{Request::old('email')}}" placeholder="Ваш email">
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
        </div>
    </div>
@endsection