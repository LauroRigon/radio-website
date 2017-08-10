<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <a class="navbar-brand" href="/"><img src="{{ URL::to('imgs/main-logo.png') }}" alt="Logo da Rádio Ciopense"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse offset-lg-2" id="menu">
            <ul class="nav navbar-nav">
                <li><a href="#" target="_blank" class="listen"><span class="fa fa-headphones"></span> Ouvir</a></li>
                <li><a href="/">Inicial</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notícias <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/">Últimas notícias</a></li>
                        <li class="dropdown-submenu">
                            <a class="drop-level" tabindex="-1" href="">Categorias <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach($categories as $category)
                                <li><a tabindex="-1" href="{{ route('post_getByCategory', $category->name) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ route('programming_indexpublic') }}">Programação</a></li>
                <li><a href="{{ route('users_indexpublic') }}">Locutores</a></li>
                <li><a href="{{ route('about') }}">Sobre</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>