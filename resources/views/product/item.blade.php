@extends('layout.layout')
@section('content')
@section('title', "{$product->title} | Sneakbox - маркетплейс кроссовок")
@section('description', "Категория: {$product->category->name} | " . str_replace(array("\r\n", "\r"), "", str_limit($product->description, $limit = 130, $end = '...')))

    <div class="product-page">
        <div class="row">
            <div class="col-md-12 title">
                <h3>{{$product->title}}</h3>
            </div>
        </div>

        <div class="row" style="margin-top: 30px; padding-bottom: 50px;">
            <div class="col-md-5 slider-block">
                <div class="slider-items">
                    @foreach($galleries as $gallery)
                        <?php $image = $gallery->image_path ?>
                        @if($image != '/uploads/default/default-placeholder-small.png')
                            <img class="img-responsive" src="{{$image}}" alt="image">
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-7 info-block">
                    <h4>Цена: {{$product->price}} грн.</h4>
                    <h4>Размер: {{$product->size->name}}</h4>
                    <h4>Категория: {{$product->category->name}}</h4>
                    <h4>Cостояние: {{$product->condition->name}}</h4>
                    <h4>Автор объявления: {{($product->user->full_name)?$product->user->full_name: $product->user->name}}</h4>
                    <h4>Дата создания: {{Carbon\Carbon::parse( $product->created_at)->format('d-m-Y')}}</h4>
                    <h4>Описание:</h4>
                    <div class="decr">
                        <p>{{$product->description}}</p>
                    </div>

                <div class="message-block">

                    <h4>Свяжитесь с автором объявления: </h4>
                    @if(\Illuminate\Support\Facades\Auth::user())

                    @if(!empty($errors))
                            <p class="{{$errors->first('message')? 'alert alert-danger':''}}" style="text-align: center">{{$errors->first('message')}}</p>
                    @endif
                    @if(session('message'))
                            <p class="alert alert-success" style="text-align: center">{{session('message')}}</p>
                    @endif
                    <form action="{{route('messages.save')}}" method="post">
                        <div class="form-group">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="hidden" name="subject" value="{{$product->title}}">
                            <input type="hidden" name="receive" value="{{$product->user_id}}">
                            <textarea class="form-control" name="message" id="" cols="30" rows="7" placeholder="Сообщение..."></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Отправить сообщение">
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                    </form>
                    @else
                        <div class="message">Сообщения могут отправлять только зарегистрированные пользователи</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection