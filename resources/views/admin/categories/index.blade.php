@extends('layouts.app')

@section('content')

    <a href="{{route('admin.categories.create')}}" class="btn btn-lg btn-success mb-5">Criar Categoria</a>
    @if($categories)
    <table class="table table-striped">
        <thead>
        <th>#</th>
        <th>Nome</th>
        <th>Ações</th>
        </thead>
        <tbody>
        @foreach($categories as $category)
        <tr>
            <td>
                {{$category->id}}
            </td>
            <td>
                {{$category->name}}
            </td>
            <td>
                <div class="btn-group">
                    <a href="{{route('admin.categories.edit', ['category' => $category->id])}}" class="btn btn-sm btn-warning mr-2">EDITAR</a>
                    <form action="{{route('admin.categories.destroy', ['category' => $category->id])}}" method="post">
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
    {{$categories->links()}}
    @endif
@endsection
