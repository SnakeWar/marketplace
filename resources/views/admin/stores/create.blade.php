@extends('layouts.app')

@section('content')
    <h1>
        Criar Loja
    </h1>

    <form action="{{route('admin.stores.store')}}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="">Nome Loja</label>
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
            <label for="">Telefone</label>
            <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}">
            @error('phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Celular/Whatsapp</label>
            <input type="text" id="mobile_phone" name="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{old('mobile_phone')}}">
            @error('mobile_phone')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Logo Loja</label>
            <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" multiple>
            @error('logo')
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
{{--            <label for="">Usuário</label>--}}
{{--            <select type="text" name="user" class="form-control">--}}
{{--                @foreach($users as $user)--}}
{{--                    <option value="{{$user->id}}">{{$user->name}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}

        <div class="form-group">
            <button type="submit" class="btn -btn-lg btn-success">
                Criar Loja
            </button>
        </div>

    </form>

@endsection

@section('scripts')

    <script>
        let imPhone = new Inputmask('(99) 9999-9999');
        imPhone.mask(document.getElementById('phone'));

        let imMobilePhone = new Inputmask('(99) 99999-9999');
        imMobilePhone.mask(document.getElementById('mobile_phone'));
    </script>

@endsection
