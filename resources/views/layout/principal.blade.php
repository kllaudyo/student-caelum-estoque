<html>
<head>
    <link rel="stylesheet" href="/css/app.css" />
    <link rel="stylesheet" href="/css/custom.css" />
    <title>Controle de estoque</title>
</head>
<body>
    <div class="container">

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/produtos/">
                        Estoque laravel
                    </a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Cadastrar</a></li>
                @else
                    <li><a href="{{route("listagemProdutos")}}">Listagem</a></li><!--usando apelidos-->
                    <li><a href="{{action("ProdutoController@novo")}}">Novo</a></li><!--usando ação direta do controller -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    Sair
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endif
                    </ul>
            </div>
        </nav>
        @yield("conteudo")
        <footer class="footer">
            <p>&copy; Livro de Laravel da Casa do Código</p>
        </footer>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>