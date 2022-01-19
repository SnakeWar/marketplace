@extends('layouts.front')

@section('content')
    <section id="banner">
        <!-- Background image -->
        <div
            class="p-5 text-center bg-image"
            style="
              background-image: url('https://images.unsplash.com/photo-1607083205410-7e6835ffd235?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2670&q=80');
              height: 600px;
              "
        >
            <div class="mask" style="background-color: rgba(0, 0, 0, 0.6)">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <h1 class="mb-5 display-4 fw-bold">Black Friday Madness</h1>
                        <h4 class="mb-5 display-1 fw-bold bg-white text-danger rounded-3">
                            90% OFF
                        </h4>
                        <a
                            class="btn btn-white text-danger btn-lg px-5 py-3 fw-bold"
                            href="#products"
                            role="button"
                            data-ripple-color="danger"
                        >View offers</a
                        >
                    </div>
                </div>
            </div>
        </div>
        <!-- Background image -->
    </section>
{{--    <section id="slide" class="mt-5">--}}
{{--        <!-- Carousel wrapper -->--}}
{{--        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">--}}
{{--            <ol class="carousel-indicators">--}}
{{--                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>--}}
{{--                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>--}}
{{--                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>--}}
{{--            </ol>--}}
{{--            <div class="carousel-inner">--}}
{{--                <div class="carousel-item active">--}}
{{--                    <img src="{{asset('assets/img/banner_img.jpg')}}" class="d-block w-100" alt="...">--}}
{{--                </div>--}}
{{--                <div class="carousel-item">--}}
{{--                    <img src="{{asset('assets/img/banner_img.jpg')}}" class="d-block w-100" alt="...">--}}
{{--                </div>--}}
{{--                <div class="carousel-item">--}}
{{--                    <img src="{{asset('assets/img/banner_img.jpg')}}" class="d-block w-100" alt="...">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">--}}
{{--                <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                <span class="sr-only">Previous</span>--}}
{{--            </button>--}}
{{--            <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">--}}
{{--                <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                <span class="sr-only">Next</span>--}}
{{--            </button>--}}
{{--        </div>--}}
{{--        <!-- Carousel wrapper -->--}}
{{--    </section>--}}
    <!--Section: Carousel-->
    <section id="products" class="mt-5">
        <div class="container">
            <div class="row justify-content-center">
                @forelse($products as $key => $product)
                    <div class="col-lg-3 col-md-4 col-sm-4 mb-5">
                        <div class="card bg-dark text-white shadow-1-strong" style="width: 100%;">
                            @if($product->photos->count())
                                <img class="card-img-top" src="{{asset('storage/' . $product->thumb)}}" alt="Imagem de capa do card">
                            @else
                                <img class="card-img-top" src="{{asset('assets/img/produto-sem-imagem.png')}}" alt="Imagem de capa do card">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{$product->name}}</h5>
                                <p class="card-text">{{$product->description}}</p>
                                <h3>R$ {{number_format($product->price, '2', ',', '.')}}</h3>
                                <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-danger">
                                    Ver Produto
                                </a>
                            </div>
                        </div>
                    </div>
                    @if($key + 1 % 3 == 0) </div><div class="row">@endif
                @empty

                @endforelse
            </div>
        </div>
    </section>

{{--    <div class="row mb-5">--}}
{{--        <div class="col-12">--}}
{{--            <h2>Lojas Destaque</h2>--}}
{{--            <hr>--}}
{{--        </div>--}}
{{--        @foreach($stores as $store)--}}

{{--            <div class="col-lg-4 col-md-4 col-sm-12">--}}
{{--                @if($store->logo)--}}
{{--                    <img src="{{asset('storage/' . $store->logo)}}" class="img-fluid" alt="Logo da Loja {{$store->name}}">--}}
{{--                @else--}}
{{--                    <img src="{{asset('assets/img/450x200.png')}}" class="img-fluid" alt="Loja sem Logo">--}}
{{--                @endif--}}
{{--                <h3>{{$store->name}}</h3>--}}
{{--                <p>--}}
{{--                    {{$store->description}}--}}
{{--                </p>--}}
{{--                    <a href="{{route('store.single', ['slug' => $store->slug])}}" class="btn btn-sm btn-success">--}}
{{--                        Ver Loja--}}
{{--                    </a>--}}
{{--            </div>--}}

{{--        @endforeach--}}
{{--    </div>--}}

@endsection
