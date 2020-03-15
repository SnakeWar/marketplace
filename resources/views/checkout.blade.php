@extends('layouts.front')

@section('stylesheets')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" class="stylesheets">
@endsection

@section('content')

    <div class="container">
        <div class="col-md-6">
            <form action="" method="post">
                <div class="row">
                    <h2>Dados para Pagamento</h2>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Número do Cartão </label><span class="brand"></span>
                        <input type="text" class="form-control" name="card_number">
                        <input type="hidden" name="card_brand">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">CPF do Cartão </label><span class="brand"></span>
                        <input id="cpf" type="text" class="form-control" name="card_cpf">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="">Nome no Cartão </label><span class="brand"></span>
                        <input type="text" class="form-control" name="card_name">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="">Mês de Expiração</label>
                        <input type="text" class="form-control" name="card_month">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Ano Expiração</label>
                        <input type="text" class="form-control" name="card_year">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Código de Segurança</label>
                        <input type="text" class="form-control" name="card_cvv">
                    </div>

                    <div class="col-md-12 installments form-group">

                    </div>
                </div>

                <button class="btn btn-success btn-lg processCheckout">Efetuar Pagamento</button>

            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{{--        <script src="{{asset('assets/js/jquery.ajax.js')}}"></script>--}}


    <script>

        const sessionId = '{{session()->get('pagseguro_session_code')}}';
        const urlThanks = '{{route('checkout.thanks')}}';
        const urlProcess = '{{route("checkout.process")}}';
        const amountTransaction = '{{$cartItems}}';
        const csrfToken = '{{csrf_token()}}';

        PagSeguroDirectPayment.setSessionId(sessionId);

    </script>

    <script src="{{asset('js/pagseguro_functions.js')}}"></script>
    <script src="{{asset('js/pagseguro_events.js')}}"></script>

    <script>
        var selector = document.getElementById("cpf");

        var im = new Inputmask("999.999.999-99");
        im.mask(selector);
    </script>
@endsection
