@extends('layouts.app')

@section('content')
    <h1>
        Editar Produto
    </h1>

    <form action="{{route('admin.products.update', ['product' => $product->id])}}" method="post" enctype="multipart/form-data">

        @csrf
        @method("PUT")

        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label for="">Nome Produto</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}">
            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$product->description}}">
            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Conteúdo</label>
            <textarea name="body" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{$product->body}}</textarea>
            @error('body')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Preço</label>
            <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="R$ {{number_format($product->price, 2, ',', '.')}}">
            @error('price')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Categorias</label>
            <select name="categories[]" id="" class="form-control" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" @if($product->categories->contains($category)) selected @endif>{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">Fotos do Produto</label>
            <input type="file" class="form-control @error('photos') is-invalid @enderror" name="photos[]" multiple>
            @error('photos')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

{{--        <div class="form-group">--}}
{{--            <label for="">Slug</label>--}}
{{--            <fieldset disabled>--}}
{{--            <input type="text" name="slug" id="disabledTextInput" class="form-control" value="{{$product->slug}}">--}}
{{--                </fieldset disabled>--}}
{{--        </div>--}}
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
                Atualizar Loja
            </button>
        </div>

    </form>

    <hr>

    <div class="row">
        @foreach($product->photos as $photo)
        <div class="col-4">
            <img src="{{asset('storage/' . $photo->image)}}" alt="" class="img-fluid">
            <form action="{{route('admin.photo.remove')}}" method="post">
                @csrf

                <input type="hidden" name="photoName" value="{{$photo->image}}">

                <button type="submit" class="btn btn-lg btn-danger my-2">REMOVER</button>

            </form>
        </div>
        @endforeach
    </div>

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
