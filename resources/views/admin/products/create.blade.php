@extends('layouts.app')

@section('content')
    <h1>
        Criar Produto
    </h1>

    <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="">Nome Produto</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}">
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Conteúdo</label>
            <textarea type="text" name="body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror" value="{{old('body')}}"></textarea>
            @error('body')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Preço</label>
            <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">
            @error('price')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Categorias</label>
            <select name="categories[]" class="form-control" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    {{$category->id}}|{{$category->name}}
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">Fotos do Produto</label>
            <input type="file" class="form-control @error('photos.*') is-invalid @enderror" name="photos[]" multiple>
            @error('photos')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

{{--        <div class="form-group">--}}
{{--            <label for="">Slug</label>--}}
{{--            <input type="text" name="slug" class="form-control">--}}
{{--        </div>--}}

{{--        <div class="form-group">--}}
{{--            <label for="">Lojas</label>--}}
{{--            <select type="text" name="store" class="form-control">--}}
{{--                @foreach($stores as $store)--}}
{{--                    <option value="{{$store->id}}">{{$store->name}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}

        <div class="form-group">
            <button type="submit" class="btn -btn-lg btn-success">
                Criar Produto
            </button>
        </div>

    </form>

@endsection

@section('scripts')
    <script src="{{asset('assets/js/jquerymaskmoney/jquery.maskMoney.min.js')}}"></script>
    <script>
        $('#price').maskMoney({
            prefix: 'R$ ',
            allowNegative: false,
            thousands: '.',
            decimal: ','
        })
    </script>
@endsection
