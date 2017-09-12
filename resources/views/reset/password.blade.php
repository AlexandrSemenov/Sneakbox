@extends('layout.layout')
@section('title', 'Sneakbox - маркетплейс кроссовок')
@section('description', 'Sneakbox - Первый маркетплейс в Украине по продаже и покупке кроссовок')

@section('content')
    <div class="row">

        <div class="col-md-offset-4 col-md-4" style="margin-top: 100px">
            <h4 style="text-align: center">Введите новый пароль</h4>

            @if($loginError = Session::get('message'))
                <p class="bg-warning" style="padding: 15px">{{$loginError}}</p>
            @endif

            <form action="{{route('password.reset.form')}}?token={{ Request::get('token') }}" method="post"
                  style="margin: 0 9px 14px 9px">
                <div class="form-group {{ $errors->first('new_pass_1')? 'has-error' : '' }}">
                    <input class="form-control" type="password" name="new_pass_1"
                           placeholder="Новый пароль">
                    @if ($errors->first('new_pass_1'))
                        <span class="help-block">{{  $errors->first('new_pass_1') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->first('new_pass_2')? 'has-error' : '' }}">
                    <input class="form-control" type="password" name="new_pass_2"
                           placeholder="Повторите новый пароль">
                    @if ($errors->first('new_pass_2'))
                        <span class="help-block">{{  $errors->first('new_pass_2') }}</span>
                    @endif
                </div>
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input class="btn btn-primary btn-block" data-num="2" type="submit"
                       value="Обновить пароль">
            </form>
        </div>
    </div>
@endsection