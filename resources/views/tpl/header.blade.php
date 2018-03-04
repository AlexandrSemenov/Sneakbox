<nav class="header">
    <div class="container">
        <div class="col-md-3 logo">
            {{--<a href="/"><img src="assets/img/logo-black.png" alt="Sneabe logo"></a>--}}
            <a href="/"></a>
        </div>
        <div class="col-md-3 menu">
            <ul>
                <li><a href="/catalog?category[]=5">Adidas</a></li>
                <li><a href="/catalog?category[]=8">Nike</a></li>
                <li><a href="/catalog?category[]=6">Asics</a></li>
                <li><a href="/catalog">Все</a></li>
            </ul>
        </div>
        <div class="col-md-6 search-registr">
            <ul>
                <li>
                    <form action="{{route('product.index')}}" method="get">
                        <input type="text" name="search"/>
                        <button type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </form>
                </li>
                @if(Auth::check())
                    <li class="add-adv"><a href="{{route('product.create')}}">Добавить объявление</a></li>
                    <li><a href="{{route('myprofile.index')}}">Профиль</a></li>
                    <li><a href="{{ route('logout') }}">Выход</a></li>
                @else
                    <li><a href="{{ route('login.register') }}">Регистрация</a></li>
                    <li><a href="{{ route('login') }}">Вход</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>