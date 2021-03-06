<nav class="navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Sneak.box</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li><a href="{{route('product.create')}}">Добавить объявление</a></li>
                    <li><a href="{{route('myprofile.index')}}">{{ Auth::user()->name }}</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('login.register') }}">Register</a></li>
                @endif
            </ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</nav>