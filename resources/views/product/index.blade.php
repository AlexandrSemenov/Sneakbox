@extends('layout.layout')
@section('content')


    <div class="row main-page" style="margin-top: 30px;">
        <div class="col-md-3">
            <form action="{{route('product.index')}}" method="get">
                <label for="">Категория: </label>
                <div class="checkbox">
                    @foreach($form->getCategoryList() as $category)
                        <div class="checkbox">
                            <label>
                                @if(!empty($_GET['category']))
                                    <input type="checkbox" name="category[]" value="{{$category->id}}"
                                    @foreach($_GET['category'] as $category_checked)
                                        {{$category->id == $category_checked ? "checked=checked" : ""}}
                                            @endforeach
                                    >
                                @else
                                    <input type="checkbox" name="category[]" value="{{$category->id}}">
                                @endif
                                {{$category->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
                <label for="">Размер:</label>
                <div class="checkbox">
                    @foreach($form->getSizeList() as $size)
                        <label class="checkbox-inline">
                            @if(!empty($_GET['size']))
                                <input type="checkbox" name="size[]" value="{{$size->id}}"
                                @foreach($_GET['size'] as $size_checked)
                                    {{$size->id == $size_checked ? "checked=checked" : ""}}
                                        @endforeach
                                >
                            @else
                                <input type="checkbox" name="size[]" value="{{$size->id}}">
                            @endif
                            {{$size->name}}
                        </label>
                    @endforeach
                </div>
                <label for="">Состояние:</label>
                <div class="checkbox">
                    @foreach($form->getConditionList() as $condition)
                        <div class="checkbox">
                            <label>
                                @if(!empty($_GET['condition']))
                                    <input type="checkbox" name="condition[]" value="{{$condition->id}}"
                                    @foreach($_GET['condition'] as $condition_checked)
                                        {{$condition->id == $condition_checked ? "checked=checked" : ""}}
                                            @endforeach
                                    >
                                @else
                                    <input type="checkbox" name="condition[]" value="{{$condition->id}}">
                                @endif
                                {{$condition->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
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
    @include('tpl.range')
@endsection