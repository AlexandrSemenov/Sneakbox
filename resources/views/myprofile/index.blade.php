@extends('layout.layout')
    @section('content')
    <div class="profile-product">
        <div class="row">
            <h3>Страница профиля</h3>
            <p>Здесь в можете поменять настройки совоей учетной записи</p>

                <div class="col-md-offset-1 col-md-10 tabs-block">


                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="" aria-controls="home" role="tab" data-toggle="tab">Объявления</a></li>
                        <li role="presentation"><a href="{{route('messages.received')}}" aria-controls="home" role="tab" data-toggle="tab">Сообщения</a></li>
                        <li role="presentation"><a href="{{route('profile.settings')}}" aria-controls="profile" role="tab" data-toggle="tab">Настройки</a></li>
                    </ul>

                    <!-- Tab panes -->
                        <div class="tab-content">
                            @foreach($products as $product)
                            <div class="row item">
                                <div class="col-md-2 photo">
                                    <img class="img-responsive" src="{{$product->image}}" alt="product image">
                                </div>
                                <div class="col-md-10 content">
                                    <h3>{{$product->title}}</h3>
                                    <ul>
                                        <li>Дата создания: {{Carbon\Carbon::parse( $product->created_at)->format('d-m-Y')}}</li>
                                        <li><a href="{{route('product.edit', ['alias' => $product->alias])}}">Редактировать</a></li>
                                        <li><a href="{{route('product.item', ['alias' => $product->alias])}}">Просмотреть</a></li>
                                        <li><a href="{{route('product.delete', ['alias' => $product->alias])}}">Удалить</a></li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                            <div class="pagination-wrapp">
                                {{$products->render()}}
                            </div>
                        </div>
                </div>
        </div>
    </div>

    @endsection