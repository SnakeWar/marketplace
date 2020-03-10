@extends('layouts.app')

@section('content')
    <h1>
        Editar Loja
    </h1>

    <form action="{{route('admin.stores.update', ['store' => $store->id])}}" method="post" enctype="multipart/form-data">

        @csrf
        @method("PUT")

        <div class="form-group">
            <label for="">Nome Loja</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$store->name}}">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$store->description}}">
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Telefone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$store->phone}}">
            @error('phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Celular/Whatsapp</label>
            <input type="text" name="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{$store->mobile_phone}}">
            @error('mobile_phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <div class="col-4">
                <img src="{{asset('storage/' . $store->logo)}}" alt="" class="img-fluid">
            </div>
            <label for="">Logo Loja</label>
            <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" multiple>
            @error('logo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Slug</label>
            <input type="text" name="slug" class="form-control disabled" value="{{$store->slug}}">
        </div>


        <div class="form-group">
            <button type="submit" class="btn -btn-lg btn-success">
                Atualizar Loja
            </button>
        </div>

    </form>

@endsection
