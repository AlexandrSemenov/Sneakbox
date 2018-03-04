@extends('layout.layout-main')
@section('title', 'Sneakbox - маркетплейс кроссовок')
@section('description', 'Sneakbox - Первый маркетплейс в Украине по продаже и покупке кроссовок')

@section('content')
    <div class="title"><span>ПОСЛЕДНИЕ ДОБАВЛЕННЫЕ МОДЕЛИ</span></div>

    <div class="row latest-items">
        @foreach($lastItems as $item)
            <div class="col-md-3 item">
                <a href="{{route('product.item', ['alias' => $item->alias])}}">
                    <img class="img-responsive" src="{{$item->image}}" alt="image">
                </a>
            </div>
        @endforeach
    </div>

    <div class="title"><span>ПОПУЛЯРНЫЕ модели</span></div>
    <div class="row wanted-items">
        <div class="item">
            <img src="assets/img/adidas.png" alt="image">
            <div class="link-block-wrap">
                <div class="link-block">
                    <div class="title-wanted">ADiDAS yeezy</div>
                    <a href="/catalog?category[]=5">посмотреть все</a>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="assets/img/nike-air-max.png" alt="image">
            <div class="link-block-wrap">
                <div class="link-block">
                    <div class="title-wanted">Undefeated Nike <br> Air Max 97</div>
                    <a href="/catalog?category[]=8">посмотреть все</a>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="assets/img/nike-jordan.png" alt="image">
            <div class="link-block-wrap">
                <div class="link-block">
                    <div class="title-wanted">NIKE JORDAN</div>
                    <a href="/catalog?category[]=8">посмотреть все</a>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="assets/img/adidas-nmd.png" alt="image">
            <div class="link-block-wrap">
                <div class="link-block">
                    <div class="title-wanted">adidas nmd</div>
                    <a href="/catalog?category[]=5">посмотреть все</a>
                </div>
            </div>
        </div>
    </div>

    <div class="title"><span>бренды</span></div>
    <div class="row brand-logo">
        <div class="col-md-2">
            <a href="/catalog?category[]=5">
                <img src="assets/img/adidas-logo.png" alt="image">
            </a>
        </div>
        <div class="col-md-2">
            <a href="/catalog?category[]=5">
                <img src="assets/img/adidas-original-logo.png" alt="image">
            </a>
        </div>
        <div class="col-md-2">
            <a href="/catalog?category[]=8">
                <img src="assets/img/nike-logo.png" alt="image">
            </a>
        </div>
        <div class="col-md-2">
            <a href="/catalog?category[]=8">
                <img src="assets/img/jordan-logo.png" alt="image">
            </a>
        </div>
        <div class="col-md-2">
            <a href="/catalog?category[]=5">
                <img src="assets/img/yeeze.png" alt="image">
            </a>
        </div>
        <div class="col-md-2">
            <a href="/catalog?category[]=13">
                <img src="assets/img/saucony.png" alt="image">
            </a>
        </div>
    </div>

    <div class="title"><span>о проекте</span></div>
    <div class="about">
        <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin,
            lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet
            nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor
            a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora
            torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus
            condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc.
            Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque.
            Suspendisse in orci enim.</p>
        <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin,
            lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet
            nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</p>
        <p>Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit.
            Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat
            justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet
            nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas
            quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</p>
    </div>
@endsection