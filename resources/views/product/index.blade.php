@extends('layout.layout')
@section('content')


    <div class="row main-page" style="margin-top: 30px;">
        <div class="col-md-3">
            <h4>Сортировать</h4>

            <form action="{{route('product.index')}}" method="get">
                <label for="">Категория: </label>
                <select class="form-control" name="category" id="category">
                    @foreach($form->getCategoryList() as $category)
                        @if(!empty($_GET['category']))
                            <option value="{{$category->id}}" {{$category->id == $_GET['category']? "selected='selected'":""}}>{{$category->name}}</option>
                        @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                </select>
                <label for="">Размер:</label>
                <select class="form-control" name="size" id="size">
                    @foreach($form->getSizeList() as $size)
                        @if(!empty($_GET['size']))
                            <option value="{{$size->id}}" {{$size->id == $_GET['size']? "selected='selected'":""}}>{{$size->name}}</option>
                        @else
                        <option value="{{$size->id}}">{{$size->name}}</option>
                        @endif
                    @endforeach
                </select>
                <label for="">Состояние:</label>
                <select class="form-control" name="condition" id="condition">
                    @foreach($form->getConditionList() as $condition)
                        @if(!empty($_GET['condition']))
                            <option value="{{$condition->id}}" {{$condition->id == $_GET['condition']? "selected='selected'":""}}>{{$condition->name}}</option>
                        @else
                        <option value="{{$condition->id}}">{{$condition->name}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="form-group">
                    <label for="amount">Ценовой диапазон:</label>
                    <input type="text" id="amount" readonly style="border:0; color:#565a5c; font-weight:bold;">
                    <input type="hidden" id="price_from" name="price_from" value="">
                    <input type="hidden" id="price_till" name="price_till" value="">
                </div>
                <div class="form-group">
                    <div id="slider-range" style="height:10px;"></div>
                </div>
                {{--<input type="hidden" name="_token" value="{{Session::token()}}">--}}
                <input class="btn btn-primary" type="submit" value="Выбрать">
            </form>
        </div>
        <div class="col-md-9 result">

                @if($products instanceof Illuminate\Pagination\LengthAwarePaginator)
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-3" style="margin: 15px 0">
                            <a href="{{route('product.item', ['alias' => $product->alias])}}">
                                <img src="{{$product->image}}" alt="image">
                            </a>
                        </div>
                    @endforeach
                </div>
                        {{ $products->appends($queryParams->getParams())->render() }}
                @else
                    <div class="row">
                        <h4>{{$products}}</h4>
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection