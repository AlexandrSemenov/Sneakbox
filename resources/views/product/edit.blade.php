@extends('layout.layout')
@section('content')
    <div class="row edit-page" style="padding-bottom: 50px;">
        <div class="col-md-offset-4 col-md-4">
            <h4 style="margin-top: 30px; text-align: center">Редактировать объявление</h4>

            <form action="{{route('product.update', ['alias' => $product->alias])}}" enctype="multipart/form-data" method="post">
                <div class="form-group {{$errors->first('title')? 'has-error':''}}">
                    <input class="form-control" type="text" name="title" value="{{$product->title}}" placeholder="Заголовок*">
                    @if ($errors->first('title'))
                        <span class="help-block">{{  $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group {{$errors->first('price')?'has-error':''}}">
                    <input class="form-control" type="text" name="price" value="{{$product->price}}" placeholder="Цена*">
                    @if ($errors->first('price'))
                        <span class="help-block">{{  $errors->first('price') }}</span>
                    @endif
                </div>
                <div class="form-group {{$errors->first('description')?'has-error':''}}">
                    <textarea class="form-control" type="text" name="description" rows="7" placeholder="Описание*">{{$product->description}}</textarea>
                    @if ($errors->first('description'))
                        <span class="help-block">{{$errors->first('description')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="category">Категория</label>
                    <select class="form-control" name="category_id" id="category">
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{$category->id}}" {{$category->id == $product->category_id ? "selected='selected'":""}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="size">Размер</label>
                    <select class="form-control" name="size" id="size">
                        @foreach(\App\Models\Size::all() as $size)
                            <option value="{{$size->id}}" {{$size->id == $product->size_id ? "selected='selected'":""}}>{{$size->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="condition">Состояние</label>
                    <select class="form-control" name="condition" id="condition">
                        @foreach(\App\Models\Condition::all() as $condition)
                            <option value="{{$condition->id}}" {{$condition->id == $product->condition_id ? "selected='selected'":""}}>{{$condition->name}}</option>
                        @endforeach
                    </select>
                </div>
                <label>Главное изображение</label>
                <div class="form-group">
                    <img src="{{$product->image}}" alt="image" style="margin-bottom: 15px;">
                    <input type="file" name="image">
                </div>

                <label>Фото галереи</label>
                @foreach($images as $key => $image)
                    <div id="gallery-image-edit-{{$key}}" data-img="{{$image->image_path}}" class="form-group image-item">
                        <div v-if="!image"></div>
                        <div v-else>
                            <div class="image-wrapp">
                                <div class="close-btn" v-on:click="removeImage"></div>
                                <img class="img-responsive" v-bind:src="image" alt="image">
                            </div>
                        </div>
                        <input class="gallery" type="file" v-on:change="onFileChange" name="gallery[]">
                        <input class="oldgallery" type="hidden" name="oldgallery[]" value="">
                    </div>
                @endforeach

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="checked" value="1" {{$product->active == 1 ? "checked='checked'":""}}> Опубликовать
                    </label>
                </div>
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input class="btn btn-primary" type="submit" value="Сохранить">
            </form>
        </div>
    </div>

@endsection