@extends('layout.layout')
@section('content')
@section('title', 'Sneakbox - маркетплейс кроссовок')
@section('description', 'Sneakbox - Первый маркетплейс в Украине по продаже и покупке кроссовок')

<div class="row create-page">

    <div class="title">Редактировать объявление</div>

    <form action="{{route('product.update', ['alias' => $product->alias])}}" enctype="multipart/form-data" method="post">
        <div class="col-md-3 info-block">
            <div class="form-group {{$errors->first('title')? 'has-error':''}}">
                <input type="text" name="title" value="{{$product->title}}"
                       placeholder="Заголовок*">
                @if ($errors->first('title'))
                    <span class="help-block">{{  $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group {{$errors->first('price')?'has-error':''}}">
                <input type="text" name="price" value="{{$product->price}}" placeholder="Цена*">
                @if ($errors->first('price'))
                    <span class="help-block">{{  $errors->first('price') }}</span>
                @endif
            </div>
            <div class="form-group {{$errors->first('description')?'has-error':''}}">
                <textarea type="text" name="description" rows="7"
                          placeholder="Описание*">{{$product->description}}</textarea>
                @if ($errors->first('description'))
                    <span class="help-block">{{$errors->first('description')}}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="category">Категория</label>
                <select name="category_id" id="category">
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{$category->id}}" {{$category->id == $product->category_id ? "selected='selected'":""}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="size">Размер</label>
                <select name="size" id="size">
                    @foreach(\App\Models\Size::all() as $size)
                        <option value="{{$size->id}}" {{$size->id == $product->size_id ? "selected='selected'":""}}>{{$size->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="condition">Состояние</label>
                <select name="condition" id="condition">
                    @foreach(\App\Models\Condition::all() as $condition)
                        <option value="{{$condition->id}}" {{$condition->id == $product->condition_id ? "selected='selected'":""}}>{{$condition->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="checkbox">
                <label class="sub-title" for="checkbox">Опубликовать</label>
                <input type="checkbox" name="checked" value="1" {{$product->active == 1 ? "checked='checked'":""}}>
            </div>
            <input type="hidden" name="_token" value="{{Session::token()}}">
            <input class="btn btn-primary" type="submit" value="Сохранить">

        </div>

        <div class="col-md-2 main-image">
            <div class="sub-title">заглавное фото</div>
            <div id="gallery-image-edit-main" data-img="{{$product->image}}" class="form-group image-item {{$errors->first('image')?'has-error':''}}">
                <div v-if="!image"></div>
                <div v-else>
                    <div class="image-wrapp">
                        <div class="close-btn" v-on:click="removeImage"></div>
                        <img class="img-responsive" v-bind:src="image">
                    </div>
                </div>

                <div class="file-upload">
                    <label for="label-main" style="display: none">
                        <div class="add-block">
                            <div class="plus">+</div>
                            Добавить
                        </div>
                        <input id="label-main" class="gallery" type="file" v-on:change="onFileChange" name="image">
                    </label>
                </div>
                @if ($errors->first('image'))
                    <span class="help-block">{{  $errors->first('image') }}</span>
                @endif
            </div>
        </div>

        <div class="col-md-6 gallery-block">
            <div class="sub-title">Фото галереи</div>

            <div class="gallery-foto-block">
                @foreach($images as $key => $image)
                    <div id="gallery-image-edit-{{$key}}" data-img="{{$image['image_path']}}" class="form-group image-item {{$errors->first("gallery.$key")?'has-error':''}}">
                        <div v-if="!image"></div>
                        <div v-else>
                            <div class="image-wrapp">
                                <div class="close-btn" v-on:click="removeImage"></div>
                                <img class="img-responsive" v-bind:src="image">
                            </div>
                        </div>


                        <div class="file-upload">
                            <label for="label-sub-{{$key}}" style="display: none">
                                <div class="add-block">
                                    <div class="plus">+</div>
                                    Добавить
                                </div>
                                <input id="label-sub-{{$key}}" class="gallery" type="file" v-on:change="onFileChange" name="gallery[]">
                                <input class="oldgallery" type="hidden" name="oldgallery[]" value="">
                            </label>
                        </div>
                        @if ($errors->first("gallery.$key"))
                            <span class="help-block">{{  $errors->first("gallery.$key") }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

    </form>

</div>

@endsection