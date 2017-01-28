@extends('layout.layout')
@section('content')

    <div class="row">
        <h3>Страница профиля</h3>
        <p>Здесь в можете поменять настройки совоей учетной записи</p>
        <div class="col-md-offset-1 col-md-10" style="margin-top: 30px">
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" ><a href="{{route('myprofile.index')}}" aria-controls="home" role="tab" data-toggle="tab">Объявления</a></li>
                    <li role="presentation" class="active"><a href="" aria-controls="home" role="tab" data-toggle="tab">Сообщения</a></li>
                    <li role="presentation"><a href="{{route('profile.settings')}}" aria-controls="profile" role="tab" data-toggle="tab">Настройки</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="">
                    <div class="tab-pane message-tab active" style="border-left: 1px solid #ddd; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd;">
                        <ul class=""style="margin-top: 20px;">
                            <li ><a href="{{route('messages.received')}}">Полученные</a></li>
                            <li class="active"><a href="">Отправленные</a></li>
                        </ul>
                        <div class="tab-message-content">
                            @foreach($conversations as $conversation)
                                <div class="row item">
                                    <div class="col-md-2 photo">
                                        @if(($count = $messageInst->countUnreadMessages($conversation->id)) > 0)
                                            <div class="count">{{ $count }}</div>
                                        @endif
                                        <img class="img-responsive" src="{{$conversationInst->getImage($conversation->product_id)}}" alt="product image">
                                    </div>
                                    <div class="col-md-10 content">
                                        <a href="{{route('message.show', ['id' => $conversation->id])}}"><h4>{{$conversation->subject}}</h4></a>
                                        <ul>
                                            <li>Дата создания: {{Carbon\Carbon::parse($conversation->created_at)->format('d-m-Y')}}</li>
                                            <li><a href="{{route('message.show', ['id' => $conversation->id])}}">Просмотреть</a></li>
                                            <li><a href="">Удалить</a></li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection