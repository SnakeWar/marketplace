<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
    <a class="navbar-brand" href="{{route('home')}}">Marketplace</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
        @auth
        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('admin/orders*')) active @endif">
                <a class="nav-link" href="{{route('admin.orders.my')}}">Meus Pedidos <span class="sr-only">(página atual)</span></a>
            </li>
            <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                <a class="nav-link" href="{{route('admin.stores.index')}}">Loja <span class="sr-only">(página atual)</span></a>
            </li>
            <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
            </li>
            <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                <a class="nav-link" href="{{route('admin.categories.index')}}">Categorias</a>
            </li>
        </ul>
        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{route('admin.notifications.index')}}" class="nav-link">
                        <span class="badge badge-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                        <i class="fa fa-bell"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <span class="nav-link">{{auth()->user()->name}}</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('form.logout').submit();">Sair</a>
                    <form action="{{route('logout')}}" class="logout" method="POST" style="display: none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</nav>
    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
</body>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
<script src="{{asset('js/app.js')}}"></script>
</html>
