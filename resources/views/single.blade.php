@extends('layouts.front')

@section('content')

    <div class="row mb-5">
        <div class="col-6">
            @if($product->photos->count())
                <img class="card-img-top" src="{{asset('storage/' . $product->photos->first()->image)}}" alt="Imagem de capa do card">
                <div class="row mt-1">
                    @foreach($product->photos as $photo)
                        <div class="col-4">
                            <img src="{{asset('storage/' . $photo->image)}}" alt="" class="img-fluid">
                        </div>
                    @endforeach
                </div>
            @else
                <img class="card-img-top" src="{{asset('assets/img/produto-sem-imagem.png')}}" alt="">
            @endif
        </div>
        <div class="col-6">
            <div class="col-12">
                <h2>{{$product->name}}</h2>
                <p>{{$product->description}}</p>
                <h3>R$ {{number_format($product->price, '2', ',', '.')}}</h3>

                <span>
                Loja: {{$product->store->name}}
            </span>
            </div>

            <div class="product-add col-md-12">
                <hr>
                <form action="{{route('cart.add')}}" method="post">
                    @csrf
                    <input type="hidden" name="product[name]" value="{{$product->name}}">
                    <input type="hidden" name="product[price]" value="{{$product->price}}">
                    <input type="hidden" name="product[slug]" value="{{$product->slug}}">
                    <div class="form-group">
                        <label for="">Quantidade</label>
                        <input type="number" name="product[amount]" class="form-control col-md-2" value="1">
                    </div>
                    <button class="btn btn-lg btn-danger">Comprar</button>
                </form>
            </div>

        </div>
    </div>

    <div class="row">
        <hr>
        <div class="col-12">
            {{$product->body}}
        </div>
    </div>

@endsection
