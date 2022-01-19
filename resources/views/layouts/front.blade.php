<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Marketplace</title>
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/estilo.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    @yield('stylesheets')
    <style>
        .active-2 a{
            color: rgba(255,255,255,.5) !important;
        }
        .active-3{
            color: #fff !important;
        }
        .desativado{
            color: #636b6f;
        }
        .dropdown-item:hover{
            background: none;
            color: #fff;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
    <a class="navbar-brand" href="{{route('home')}}">Marketplace</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @if(request()->is('/')) active @endif">
                    <a class="nav-link text-white" href="{{route('home')}}">Home <span class="sr-only">(página atual)</span></a>
                </li>
                <li class="nav-item dropdown @if(!request()->is('category/*')) active-2 @endif">
                    <a class="nav-link dropdown-toggle text-white" style="" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorias
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="background-color: #343a40;border: none">
                        @foreach($categories as $category)
                            <a class="dropdown-item text-white desativado @if(request()->is('category/' . $category->slug)) active-3 @endif" href="{{route('category.single', ['slug' => $category->slug])}}">{{$category->name}}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    <!-- Instagram -->
                    <a class="btn btn-primary" style="background-color: #f93154" href="https://www.instagram.com/bbcollectibles_br/" role="button"><i class="fab fa-instagram"></i></a>
                </li>
{{--                @foreach($categories as $category)--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{route('category.single', ['slug' => $category->slug])}}">{{$category->name}}</a>--}}
{{--                    </li>--}}
{{--                @endforeach--}}
            </ul>
            <div class="my-2 my-lg-0">
                <ul class="navbar-nav mr-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login <span class="sr-only">(página atual)</span></a>
                    </li>
                    @endguest
                        <li class="nav-item">
                            <a href="{{route('cart.index')}}" class="nav-link">
                                @if(session()->has('cart'))
                                    {{--                                <span class="badge badge-danger">{{array_sum(array_column(session()->get('cart'), 'amount'))}}</span>--}}
                                    <span class="badge badge-danger">{{count(session()->get('cart'))}}</span>
                                @endif
                                <i class="fa fa-shopping-cart fa-2x"></i>
                            </a>
                        </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.stores.index')}}">{{auth()->user()->name}}</a>
                    </li>
                    <li class="nav-item @if(request()->is('my-orders')) active @endif">
                        <a class="nav-link" href="{{route('user.orders')}}">Meus Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('form.logout').submit();">Sair</a>
                        <form action="{{route('logout')}}" class="logout" method="POST" style="display: none">
                            @csrf
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>

        </div>
</nav>
<div class="container">
    @include('flash::message')
    @yield('content')
</div>

{{--<script src="https://code.jquery.com/jquery-2.2.4.min.js"--}}
{{--        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="--}}
{{--        crossorigin="anonymous"></script>--}}
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
@yield('scripts')
</body>
</html>
