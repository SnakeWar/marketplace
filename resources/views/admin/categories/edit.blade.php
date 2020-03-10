@extends('layouts.app')

@section('content')
    <h1>
        Editar Categoria
    </h1>

    <form action="{{route('admin.categories.update', ['category' => $category->id])}}" method="post">

        @csrf
        @method("PUT")

        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label for="">Nome Categoria</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$category->name}}">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$category->description}}">
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Slug</label>
            <input type="text" name="slug" class="form-control disabled" value="{{$category->slug}}">
        </div>

{{--        <div class="form-group">--}}
{{--            <label for="">Lojas</label>--}}
{{--            <select type="text" name="stores" class="form-control" value="{{$store->name}}">--}}
{{--                @foreach($stores as $store)--}}
{{--                    <option value="{{$store->id}}">{{$store->name}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}


        <div class="form-group">
            <button type="submit" class="btn -btn-lg btn-success">
                Atualizar Categoria
            </button>
        </div>

    </form>

@endsection
