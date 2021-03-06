@extends('layouts.front')

@section('content')
    <div class="row">
        @forelse($products as $key => $product)
            <div class="col-lg-4 col-md-4 col-sm-4 mb-5">
                <div class="card" style="width: 100%;">
                    @if($product->photos->count())
                        <img class="card-img-top" src="{{asset('storage/' . $product->photos->first()->image)}}" alt="Imagem de capa do card">
                    @else
                        <img class="card-img-top" src="{{asset('assets/img/produto-sem-imagem.png')}}" alt="Imagem de capa do card">
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

        @endforelse
    </div>

    <div class="row mb-5">
        <div class="col-12">
            <h2>Lojas Destaque</h2>
            <hr>
        </div>
        @foreach($stores as $store)

            <div class="col-lg-4 col-md-4 col-sm-12">
                @if($store->logo)
                    <img src="{{asset('storage/' . $store->logo)}}" class="img-fluid" alt="Logo da Loja {{$store->name}}">
                @else
                    <img src="{{asset('assets/img/450x200.png')}}" class="img-fluid" alt="Loja sem Logo">
                @endif
                <h3>{{$store->name}}</h3>
                <p>
                    {{$store->description}}
                </p>
                    <a href="{{route('store.single', ['slug' => $store->slug])}}" class="btn btn-sm btn-success">
                        Ver Loja
                    </a>
            </div>

        @endforeach
    </div>

@endsection
