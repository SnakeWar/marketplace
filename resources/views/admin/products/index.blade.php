@extends('layouts.app')

@section('content')

    <a href="{{route('admin.products.create')}}" class="btn btn-lg btn-success mb-5">Criar Produto</a>
    @if($products)
    <table class="table table-striped">
        <thead>
        <th>#</th>
        <th>Produtos</th>
        <th>Preço</th>
        <th>Loja</th>
        <th>Ações</th>
        </thead>
        <tbody>
        @foreach($products as $product)
        <tr>
            <td>
                {{$product->id}}
            </td>
            <td>
                {{$product->name}}
            </td>
            <td>
                R$ {{number_format($product->price, 2, ',', '.')}}
            </td>
            <td>
                {{$product->store->name}}
            </td>
            <td>
                <div class="btn-group">
                    <a href="{{route('admin.products.edit', ['product' => $product->id])}}" class="btn btn-sm btn-warning">EDITAR</a>
                    <form action="{{route('admin.products.destroy', ['product' => $product->id])}}" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-sm btn-danger">REMOVER</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{$products->links()}}
    @endif
@endsection
