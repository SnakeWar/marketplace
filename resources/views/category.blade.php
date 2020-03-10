@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>{{$category->name}}</h2>
            <hr>
        </div>
        @forelse($category->products as $key => $product)
            <div class="col-lg-4 col-md-4 col-sm-4 mb-5">
                <div class="card" style="width: 100%;">
                    @if($product->photos->count())
                        <img class="card-img-top" src="{{asset('storage/' . $product->photos->first()->image)}}" alt="Imagem de capa do card">
                    @else
                        <img class="card-img-top" src="{{asset('assets/img/produto-sem-imagem')}}" alt="Imagem de capa do card">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">{{$product->description}}</p>
                        <h3>R$ {{number_format($product->price, '2', ',', '.')}}</h3>
                        <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-success">
                            Ver Produto
                        </a>
                    </div>
                </div>
            </div>
            @if($key + 1 % 3 == 0) </div><div class="row">@endif
        @empty
            <div class="col-12">
                <h3 class="alert alert-warning">
                    Nenhum produto encontrado para esse categoria...
                </h3>
            </div>
        @endforelse
    </div>

{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <h2>Lojas Destaque</h2>--}}
{{--            <hr>--}}
{{--        </div>--}}
{{--        @foreach($stores as $store)--}}

{{--            <div class="col-4">--}}
{{--                @if($store->logo)--}}
{{--                    <img src="{{asset('storage/' . $store->logo)}}" class="img-fluid" alt="Logo da Loja {{$store->name}}">--}}
{{--                @else--}}
{{--                    <img src="{{asset('assets/img/450x100.png')}}" class="img-fluid" alt="Loja sem Logo">--}}
{{--                @endif--}}
{{--                <h3>{{$store->name}}</h3>--}}
{{--                <p>--}}
{{--                    {{$store->description}}--}}
{{--                </p>--}}
{{--            </div>--}}

{{--        @endforeach--}}
{{--    </div>--}}

@endsection
