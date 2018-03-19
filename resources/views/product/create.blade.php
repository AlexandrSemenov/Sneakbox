@extends('layout.layout')
@section('content')
@section('title', 'Sneakbox - маркетплейс кроссовок')
@section('description', 'Sneakbox - Первый маркетплейс в Украине по продаже и покупке кроссовок')

<div class="row create-page">

    <div class="title">Создать объявление</div>

    <form action="{{route('product.save')}}" enctype="multipart/form-data" method="post">
        <div class="col-md-3 info-block">
            <div class="form-group {{$errors->first('title')? 'has-error':''}}">
                <input type="text" name="title" value="{{Request::old('title')}}"
                       placeholder="Заголовок*">
                @if ($errors->first('title'))
                    <span class="help-block">{{  $errors->first('title') }}</span>
                @endif
            </div>
            <div class="form-group {{$errors->first('price')?'has-error':''}}">
                <input type="text" name="price" value="{{Request::old('price')}}"
                       placeholder="Цена*">
                @if ($errors->first('price'))
                    <span class="help-block">{{  $errors->first('price') }}</span>
                @endif
            </div>
            <div class="form-group {{$errors->first('description')?'has-error':''}}">
                <textarea type="text" name="description"
                          placeholder="Описание*">{{Request::old('description')}}</textarea>
                @if ($errors->first('description'))
                    <span class="help-block">{{  $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="sub-title" for="category">Категория</label>
                <select name="category_id" id="category">
                    @foreach($form->getCategoryList() as $category)
                        <option value="{{$category->id}}" {{ !empty(old('category_id')) && ($category->id == old('category_id')) ? ' selected="selected"' : '' }}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="sub-title" for="size">Размер</label>
                <select name="size" id="size">
                    @foreach($form->getSizeList() as $size)
                        <option value="{{$size->id}}" {{ !empty(old('size')) && ($size->id == old('size')) ? ' selected="selected"' : '' }}>{{$size->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="sub-title" for="condition">Состояние</label>
                <select name="condition" id="condition">
                    @foreach($form->getConditionList() as $condition)
                        <option value="{{$condition->id}}" {{ !empty(old('condition')) && ($condition->id == old('condition')) ? ' selected="selected"' : '' }}>{{$condition->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="checkbox">
                <label class="sub-title" for="checkbox">Опубликовать</label>
                <input id="checkbox" type="checkbox" name="checked" value="1">
            </div>
            <input type="hidden" name="_token" value="{{Session::token()}}">
            <input class="btn btn-primary" type="submit" value="Создать">
        </div>

        <div class="col-md-2 main-image">
            <div id="main-image" class="form-group {{$errors->first('image')?'has-error':''}}">
                <div class="sub-title">заглавное фото</div>
                <div v-if="!image"></div>
                <div v-else>
                    <div class="image-wrapp">
                        <div class="close-btn" v-on:click="removeImage"></div>
                        <img class="prev-image" v-bind:src="image" alt="preview-image">
                    </div>
                </div>
                <div class="file-upload">
                    <label for="label-main">
                        <div class="add-block">
                            <div class="plus">+</div>
                            Добавить
                        </div>
                        <input type="file" id="label-main" v-on:change="onFileChange" name="image">
                    </label>
                </div>
                @if ($errors->first('image'))
                    <span class="help-block">{{  $errors->first('image') }}</span>
                @endif
            </div>
        </div>
        <div class="col-md-6 gallery-block">
            <div class="sub-title">ОСТАЛЬНЫЕ ФОТО</div>
            <div class="gallery-foto-block">
                <!-- Gallery image 1 -->
                <div id="gallery-image-1" class="form-group {{$errors->first('gallery.0')?'has-error':''}}">
                    <div v-if="!image"></div>
                    <div v-else>
                        <div class="image-wrapp">
                            <div class="close-btn" v-on:click="removeImage"></div>
                            <img class="prev-image" v-bind:src="image" alt="preview-image">
                        </div>
                    </div>
                    <div class="file-upload">
                        <label for="label-sub-1">
                            <div class="add-block">
                                <div class="plus">+</div>
                                Добавить
                            </div>
                            <input type="file" id="label-sub-1" v-on:change="onFileChange" name="gallery[]">
                        </label>
                    </div>
                    @if ($errors->first('gallery.0'))
                        <span class="help-block">{{  $errors->first('gallery.0') }}</span>
                    @endif
                </div>
                <!-- END Gallery image 1 -->

                <!-- Gallery image 2 -->
                <div id="gallery-image-2" class="form-group {{$errors->first('gallery.1')?'has-error':''}}">
                    <div v-if="!image"></div>
                    <div v-else>
                        <div class="image-wrapp">
                            <div class="close-btn" v-on:click="removeImage"></div>
                            <img class="prev-image" v-bind:src="image" alt="preview-image">
                        </div>
                    </div>
                    <div class="file-upload">
                        <label for="label-sub-2">
                            <div class="add-block">
                                <div class="plus">+</div>
                                Добавить
                            </div>
                            <input type="file" id="label-sub-2" v-on:change="onFileChange" name="gallery[]">
                        </label>
                    </div>
                    @if ($errors->first('gallery.1'))
                        <span class="help-block">{{  $errors->first('gallery.1') }}</span>
                    @endif
                </div>
                <!-- END Gallery image 2 -->

                <!-- Gallery image 3 -->
                <div id="gallery-image-3" class="form-group {{$errors->first('gallery.2')?'has-error':''}}">
                    <div v-if="!image"></div>
                    <div v-else>
                        <div class="image-wrapp">
                            <div class="close-btn" v-on:click="removeImage"></div>
                            <img class="prev-image" v-bind:src="image" alt="preview-image">
                        </div>
                    </div>
                    <div class="file-upload">
                        <label for="label-sub-3">
                            <div class="add-block">
                                <div class="plus">+</div>
                                Добавить
                            </div>
                            <input type="file" id="label-sub-3" v-on:change="onFileChange" name="gallery[]">
                        </label>
                    </div>
                    @if ($errors->first('gallery.2'))
                        <span class="help-block">{{  $errors->first('gallery.2') }}</span>
                    @endif
                </div>
                <!-- END Gallery image 3 -->

                <!-- Gallery image 4 -->
                <div id="gallery-image-4" class="form-group {{$errors->first('gallery.3')?'has-error':''}}">
                    <div v-if="!image"></div>
                    <div v-else>
                        <div class="image-wrapp">
                            <div class="close-btn" v-on:click="removeImage"></div>
                            <img class="prev-image" v-bind:src="image" alt="preview-image">
                        </div>
                    </div>
                    <div class="file-upload">
                        <label for="label-sub-4">
                            <div class="add-block">
                                <div class="plus">+</div>
                                Добавить
                            </div>
                            <input type="file" id="label-sub-4" v-on:change="onFileChange" name="gallery[]">
                        </label>
                    </div>
                    @if ($errors->first('gallery.3'))
                        <span class="help-block">{{  $errors->first('gallery.3') }}</span>
                    @endif
                </div>
                <!-- END Gallery image 4 -->

                <!-- Gallery image 5 -->
                <div id="gallery-image-5" class="form-group {{$errors->first('gallery.4')?'has-error':''}}">
                    <div v-if="!image"></div>
                    <div v-else>
                        <div class="image-wrapp">
                            <div class="close-btn" v-on:click="removeImage"></div>
                            <img class="prev-image" v-bind:src="image" alt="preview-image">
                        </div>
                    </div>
                    <div class="file-upload">
                        <label for="label-sub-5">
                            <div class="add-block">
                                <div class="plus">+</div>
                                Добавить
                            </div>
                            <input type="file" id="label-sub-5" v-on:change="onFileChange" name="gallery[]">
                        </label>
                    </div>
                    @if ($errors->first('gallery.4'))
                        <span class="help-block">{{  $errors->first('gallery.4') }}</span>
                    @endif
                </div>
                <!-- END Gallery image 5 -->

                <!-- Gallery image 6 -->
                <div id="gallery-image-6" class="form-group {{$errors->first('gallery.5')?'has-error':''}}">
                    <div v-if="!image"></div>
                    <div v-else>
                        <div class="image-wrapp">
                            <div class="close-btn" v-on:click="removeImage"></div>
                            <img class="prev-image" v-bind:src="image" alt="preview-image">
                        </div>
                    </div>
                    <div class="file-upload">
                        <label for="label-sub-6">
                            <div class="add-block">
                                <div class="plus">+</div>
                                Добавить
                            </div>
                            <input type="file" id="label-sub-6" v-on:change="onFileChange" name="gallery[]">
                        </label>
                    </div>
                    @if ($errors->first('gallery.5'))
                        <span class="help-block">{{  $errors->first('gallery.5') }}</span>
                    @endif
                </div>
                <!-- END Gallery image 6 -->

                <!-- Gallery image 7 -->
                <div id="gallery-image-7" class="form-group {{$errors->first('gallery.6')?'has-error':''}}">
                    <div v-if="!image"></div>
                    <div v-else>
                        <div class="image-wrapp">
                            <div class="close-btn" v-on:click="removeImage"></div>
                            <img class="prev-image" v-bind:src="image" alt="preview-image">
                        </div>
                    </div>
                    <div class="file-upload">
                        <label for="label-sub-7">
                            <div class="add-block">
                                <div class="plus">+</div>
                                Добавить
                            </div>
                            <input type="file" id="label-sub-7" v-on:change="onFileChange" name="gallery[]">
                        </label>
                    </div>
                    @if ($errors->first('gallery.6'))
                        <span class="help-block">{{  $errors->first('gallery.6') }}</span>
                    @endif
                </div>
                <!-- END Gallery image 7 -->

                <!-- Gallery image 8 -->
                <div id="gallery-image-8" class="form-group {{$errors->first('gallery.7')?'has-error':''}}">
                    <div v-if="!image"></div>
                    <div v-else>
                        <div class="image-wrapp">
                            <div class="close-btn" v-on:click="removeImage"></div>
                            <img class="prev-image" v-bind:src="image" alt="preview-image">
                        </div>
                    </div>
                    <div class="file-upload">
                        <label for="label-sub-8">
                            <div class="add-block">
                                <div class="plus">+</div>
                                Добавить
                            </div>
                            <input type="file" id="label-sub-8" v-on:change="onFileChange" name="gallery[]">
                        </label>
                    </div>
                    @if ($errors->first('gallery.7'))
                        <span class="help-block">{{  $errors->first('gallery.7') }}</span>
                    @endif
                </div>
                <!-- END Gallery image 8 -->
            </div>
        </div>

    </form>

</div>

@endsection