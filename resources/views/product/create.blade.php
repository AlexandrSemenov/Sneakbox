@extends('layout.layout')
@section('content')
    <div class="row create-page" style="padding-bottom: 50px;">
        <div class="col-md-offset-4 col-md-4">
            <h4 style="margin-top: 30px; text-align: center">Создать объявление</h4>

            <form action="{{route('product.save')}}" enctype="multipart/form-data" method="post">
                <div class="form-group {{$errors->first('title')? 'has-error':''}}">
                    <input class="form-control" type="text" name="title" value="{{Request::old('title')}}" placeholder="Заголовок*">
                    @if ($errors->first('title'))
                        <span class="help-block">{{  $errors->first('title') }}</span>
                    @endif
                </div>
                <div class="form-group {{$errors->first('price')?'has-error':''}}">
                    <input class="form-control" type="text" name="price" value="{{Request::old('price')}}" placeholder="Цена*">
                    @if ($errors->first('price'))
                        <span class="help-block">{{  $errors->first('price') }}</span>
                    @endif
                </div>
                <div class="form-group {{$errors->first('description')?'has-error':''}}">
                    <textarea class="form-control" type="text" name="description" placeholder="Описание*">{{Request::old('description')}}</textarea>
                    @if ($errors->first('description'))
                        <span class="help-block">{{  $errors->first('description') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="category">Категория</label>
                    <select class="form-control" name="category_id" id="category">
                        @foreach($form->getCategoryList() as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="size">Размер</label>
                    <select class="form-control" name="size" id="size">
                        @foreach($form->getSizeList() as $size)
                            <option value="{{$size->id}}">{{$size->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="condition">Состояние</label>
                    <select class="form-control" name="condition" id="condition">
                        @foreach($form->getConditionList() as $condition)
                            <option value="{{$condition->id}}">{{$condition->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div id="main-image" class="form-group {{$errors->first('image')?'has-error':''}}">
                    <label>Добавить заглавное фото</label>
                    <div v-if="!image">

                    </div>
                    <div v-else>
                        <div class="image-wrapp">
                            <div class="close-btn" v-on:click="removeImage"></div>
                            <img class="prev-image" v-bind:src="image" alt="preview-image">
                        </div>
                    </div>
                    <input type="file" v-on:change="onFileChange" name="image">
                    @if ($errors->first('image'))
                        <span class="help-block">{{  $errors->first('image') }}</span>
                    @endif
                </div>

                {{--<div class="form-group">--}}
                    {{--<lable id="gallery">Добавить фото для галереи</lable>--}}
                    {{--<input type="file" id="gallery" name="gallery[]" multiple>--}}
                {{--</div>--}}

                <div class="gallery-input-block">
                    <label>Добавить фото для галереи (не более 8 фото)</label>
                    <!-- Gallery image 1 -->
                    <div id="gallery-image-1" class="form-group {{$errors->first('gallery.0')?'has-error':''}}">
                        <lable id="gallery">Фото 1</lable>
                        <div v-if="!image">

                        </div>
                        <div v-else>
                            <div class="image-wrapp">
                                <div class="close-btn" v-on:click="removeImage"></div>
                                <img class="prev-image" v-bind:src="image" alt="preview-image">
                            </div>
                        </div>
                        <input type="file" id="gallery" v-on:change="onFileChange" name="gallery[]">
                        @if ($errors->first('gallery.0'))
                            <span class="help-block">{{  $errors->first('gallery.0') }}</span>
                        @endif
                    </div>
                    <!-- END Gallery image 1 -->

                    <!-- Gallery image 2 -->
                    <div id="gallery-image-2" class="form-group {{$errors->first('gallery.1')?'has-error':''}}">
                        <lable id="gallery">Фото 2</lable>
                        <div v-if="!image">

                        </div>
                        <div v-else>
                            <div class="image-wrapp">
                                <div class="close-btn" v-on:click="removeImage"></div>
                                <img class="prev-image" v-bind:src="image" alt="preview-image">
                            </div>
                        </div>
                        <input type="file" id="gallery" v-on:change="onFileChange" name="gallery[]">
                        @if ($errors->first('gallery.1'))
                            <span class="help-block">{{  $errors->first('gallery.1') }}</span>
                        @endif
                    </div>
                    <!-- END Gallery image 2 -->

                    <!-- Gallery image 3 -->
                    <div id="gallery-image-3" class="form-group {{$errors->first('gallery.2')?'has-error':''}}">
                        <lable id="gallery">Фото 3</lable>
                        <div v-if="!image">

                        </div>
                        <div v-else>
                            <div class="image-wrapp">
                                <div class="close-btn" v-on:click="removeImage"></div>
                                <img class="prev-image" v-bind:src="image" alt="preview-image">
                            </div>
                        </div>
                        <input type="file" id="gallery" v-on:change="onFileChange" name="gallery[]">
                        @if ($errors->first('gallery.2'))
                            <span class="help-block">{{  $errors->first('gallery.2') }}</span>
                        @endif
                    </div>
                    <!-- END Gallery image 3 -->

                    <!-- Gallery image 4 -->
                    <div id="gallery-image-4" class="form-group {{$errors->first('gallery.3')?'has-error':''}}">
                        <lable id="gallery">Фото 4</lable>
                        <div v-if="!image">

                        </div>
                        <div v-else>
                            <div class="image-wrapp">
                                <div class="close-btn" v-on:click="removeImage"></div>
                                <img class="prev-image" v-bind:src="image" alt="preview-image">
                            </div>
                        </div>
                        <input type="file" id="gallery" v-on:change="onFileChange" name="gallery[]">
                        @if ($errors->first('gallery.3'))
                            <span class="help-block">{{  $errors->first('gallery.3') }}</span>
                        @endif
                    </div>
                    <!-- END Gallery image 4 -->

                    <!-- Gallery image 5 -->
                    <div id="gallery-image-5" class="form-group {{$errors->first('gallery.4')?'has-error':''}}">
                        <lable id="gallery">Фото 5</lable>
                        <div v-if="!image">

                        </div>
                        <div v-else>
                            <div class="image-wrapp">
                                <div class="close-btn" v-on:click="removeImage"></div>
                                <img class="prev-image" v-bind:src="image" alt="preview-image">
                            </div>
                        </div>
                        <input type="file" id="gallery" v-on:change="onFileChange" name="gallery[]">
                        @if ($errors->first('gallery.4'))
                            <span class="help-block">{{  $errors->first('gallery.4') }}</span>
                        @endif
                    </div>
                    <!-- END Gallery image 5 -->

                    <!-- Gallery image 6 -->
                    <div id="gallery-image-6" class="form-group {{$errors->first('gallery.5')?'has-error':''}}">
                        <lable id="gallery">Фото 6</lable>
                        <div v-if="!image">

                        </div>
                        <div v-else>
                            <div class="image-wrapp">
                                <div class="close-btn" v-on:click="removeImage"></div>
                                <img class="prev-image" v-bind:src="image" alt="preview-image">
                            </div>
                        </div>
                        <input type="file" id="gallery" v-on:change="onFileChange" name="gallery[]">
                        @if ($errors->first('gallery.5'))
                            <span class="help-block">{{  $errors->first('gallery.5') }}</span>
                        @endif
                    </div>
                    <!-- END Gallery image 6 -->

                    <!-- Gallery image 7 -->
                    <div id="gallery-image-7" class="form-group {{$errors->first('gallery.6')?'has-error':''}}">
                        <lable id="gallery">Фото 7</lable>
                        <div v-if="!image">

                        </div>
                        <div v-else>
                            <div class="image-wrapp">
                                <div class="close-btn" v-on:click="removeImage"></div>
                                <img class="prev-image" v-bind:src="image" alt="preview-image">
                            </div>
                        </div>
                        <input type="file" id="gallery" v-on:change="onFileChange" name="gallery[]">
                        @if ($errors->first('gallery.6'))
                            <span class="help-block">{{  $errors->first('gallery.6') }}</span>
                        @endif
                    </div>
                    <!-- END Gallery image 7 -->

                    <!-- Gallery image 8 -->
                    <div id="gallery-image-8" class="form-group {{$errors->first('gallery.7')?'has-error':''}}">
                        <lable id="gallery">Фото 8</lable>
                        <div v-if="!image">

                        </div>
                        <div v-else>
                            <div class="image-wrapp">
                                <div class="close-btn" v-on:click="removeImage"></div>
                                <img class="prev-image" v-bind:src="image" alt="preview-image">
                            </div>
                        </div>
                        <input type="file" id="gallery" v-on:change="onFileChange" name="gallery[]">
                        @if ($errors->first('gallery.7'))
                            <span class="help-block">{{  $errors->first('gallery.7') }}</span>
                        @endif
                    </div>
                    <!-- END Gallery image 8 -->

                </div>
                {{--<div class="btn btn-primary more-gallery-input">Добавить фото</div>--}}

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="checked" value="1"> Опубликовать
                    </label>
                </div>
                <input type="hidden" name="_token" value="{{Session::token()}}">
                <input class="btn btn-primary" type="submit" value="Создать">
            </form>
        </div>
    </div>

@endsection