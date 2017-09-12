@extends('layout.layout')
@section('title', 'Sneakbox - маркетплейс кроссовок')
@section('description', 'Sneakbox - Первый маркетплейс в Украине по продаже и покупке кроссовок')

@section('content')
    <div class="col-md-offset-3 col-md-6 message-show">
        <div class="row" style="margin: 30px 0">
            <h4>Сообщения</h4>
            @foreach($messages as $message)
                <div class="message {{Auth::user()->id == $message->send? 'send':'receive'}}">
                    <div class="body">{{$message->message}}</div>
                    <div class="message-info">
                        <div class="item create-date">{{Carbon\Carbon::parse($message->created_at)->format('d-m-y')}}</div>
                        <div class="item create-date">{{Carbon\Carbon::parse($message->created_at)->format('G:i')}}</div>
                        <div class="item user"> {{$message->user->name}}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row" style="margin: 30px 0">
            @if(!empty($errors))
                <p class="{{$errors->first('message')? 'alert alert-danger':''}}" style="text-align: center">{{$errors->first('message')}}</p>
            @endif
            @if(session('message'))
                <p class="alert alert-success" style="text-align: center">{{session('message')}}</p>
            @endif
            <form action="{{route('message.answer')}}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" placeholder="Текст сообщения..."></textarea>
                </div>
                <input type="hidden" name="conversation_id" value="{{$message->conversation_id}}">
                <input type="hidden" name="product_id" value="{{$message->product_id}}">
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input class="btn btn-primary" type="submit" value="Отправить сообщение">
            </form>
        </div>
    </div>
@endsection