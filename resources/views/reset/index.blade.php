@extends('layout.layout')
@section('title', 'Sneakbox - маркетплейс кроссовок')
@section('description', 'Sneakbox - Первый маркетплейс в Украине по продаже и покупке кроссовок')

@section('content')
    <div class="row">

        <div class="col-md-offset-4 col-md-4" style="margin-top: 100px">
            <h5 style="text-align: center">Введите email который зарегистрирован в системе</h5>

            @if($notification = Session::get('notification'))
                <p class="bg-success" style="padding: 15px">{{$notification}}</p>
            @endif

            <form action="{{route('password.reset')}}" method="post"
                  style="margin: 0 9px 14px 9px">
                <div class="form-group {{ $errors->first('email')? 'has-error' : '' }}">
                    <input class="form-control" type="text" name="email"
                           placeholder="Email">
                    @if ($errors->first('email'))
                        <span class="help-block">{{  $errors->first('email') }}</span>
                    @endif
                </div>

                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input class="btn btn-primary btn-block" data-num="2" type="submit"
                       value="Отправить">
            </form>
        </div>
    </div>
@endsection