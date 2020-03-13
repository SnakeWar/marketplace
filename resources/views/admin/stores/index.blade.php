@extends('layouts.app')

@section('content')
    @if(!$store)
    <a href="{{route('admin.stores.create')}}" class="btn btn-lg btn-success mb-5">Criar Loja</a>
    @endif
    @if($store != null)
    <table class="table table-striped">
        <thead>
        <th>#</th>
        <th>Loja</th>
        <th>Total de Produtos</th>
        <th>Ações</th>
        </thead>
        <tbody>
{{--        @foreach($stores as $store)--}}
            <tr>
                <td>
                    {{$store->id}}
                </td>
                <td>
                    {{$store->name}}
                </td>
                <td>
                    {{$store->products->count()}}
                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{route('admin.stores.edit', ['store' => $store->id])}}" class="btn btn-sm btn-warning mr-2">EDITAR</a>
                        <form action="{{route('admin.stores.destroy', ['store' => $store->id])}}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-sm btn-danger">REMOVER</button>
                        </form>
                    </div>
                </td>
            </tr>
{{--        @endforeach--}}
        </tbody>
    </table>
    @endif
{{--    {{$stores->links()}}--}}

@endsection
