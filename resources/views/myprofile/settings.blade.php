@extends('layout.layout')
@section('content')

    <div class="row">
        <h3>Страница профиля</h3>
        <p>Здесь в можете поменять настройки совоей учетной записи</p>
        <div class="col-md-offset-1 col-md-10" style="margin-top: 30px">
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li><a href="{{route('myprofile.index')}}" aria-controls="home" role="tab" data-toggle="tab">Объявления</a></li>
                    <li><a href="{{route('messages.received')}}" aria-controls="home" role="tab" data-toggle="tab">Сообщения</a></li>
                    <li class="active"><a href="" aria-controls="profile" role="tab" data-toggle="tab">Настройки</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="">
                    <div role="tabpanel" class="" id="profile" style="border-left: 1px solid #ddd; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd;">
                        <div class="row">
                            <div class="col-md-offset-1 col-md-5" style="margin-top: 25px; margin-bottom: 25px;">

                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <div role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <h5 style="text-align: center">Изменить контактные данные</h5>
                                                </div>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in" data-num="1" role="tabpanel" aria-labelledby="headingOne">
                                            @if(Session::has('message'))
                                                <p class="bg-success text-success" style="padding: 15px; text-align: center">{{Session::get('message')}}</p>
                                            @endif

                                            <form action="{{route('profile.update')}}" method="post" style="margin: 0 9px 14px 9px">
                                                <div class="form-group {{ $errors->first('city')? 'has-error' : '' }}">
                                                    <input class="form-control" type="text" name="city" value="{{$user->city}}" placeholder="Ваш город">
                                                    @if ($errors->first('city'))
                                                        <span class="help-block">{{  $errors->first('city') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->first('full_name')? 'has-error' : '' }}">
                                                    <input class="form-control" type="text" name="full_name" value="{{$user->full_name}}" placeholder="Ваше полное имя">
                                                    @if ($errors->first('full_name'))
                                                        <span class="help-block">{{  $errors->first('full_name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->first('phone')? 'has-error' : '' }}">
                                                    <input class="form-control" type="text" name="phone" value="{{$user->phone}}" placeholder="Ваш телефон">
                                                    @if ($errors->first('phone'))
                                                        <span class="help-block">{{  $errors->first('phone') }}</span>
                                                    @endif
                                                </div>
                                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                                <input class="btn btn-primary btn-block" data-num="1" type="submit" value="Обновить">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div  role="tab" id="headingTwo">
                                            <h4 class="panel-title">
                                                <div class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <h5 style="text-align: center">Изменить пароль</h5>
                                                </div>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" data-num="2" role="tabpanel" aria-labelledby="headingTwo">
                                            @if(Session::has('message2'))
                                                <p class="bg-success text-success" style="padding: 15px; text-align: center">{{Session::get('message2')}}</p>
                                            @endif

                                            <form action="{{route('pass.update')}}" method="post" style="margin: 0 9px 14px 9px">
                                                <div class="form-group {{ $errors->first('new_pass_1')? 'has-error' : '' }}">
                                                    <input class="form-control" type="password" name="new_pass_1" placeholder="Новый пароль">
                                                    @if ($errors->first('new_pass_1'))
                                                        <span class="help-block">{{  $errors->first('new_pass_1') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->first('new_pass_2')? 'has-error' : '' }}">
                                                    <input class="form-control" type="password" name="new_pass_2" placeholder="Повторите новый пароль">
                                                    @if ($errors->first('new_pass_2'))
                                                        <span class="help-block">{{  $errors->first('new_pass_2') }}</span>
                                                    @endif
                                                </div>
                                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                                <input class="btn btn-primary btn-block" data-num="2" type="submit" value="Обновить пароль">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Collapsible Group Item #3
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                            <div class="panel-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection