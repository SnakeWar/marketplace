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
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script>
        let amountTransaction = '{{$cartItems}}';
        let cardNumber = document.querySelector('input[name=card_number]');
        let spanBrand = document.querySelector('span.brand');
        cardNumber.addEventListener('keyup', function () {
            // console.log(cardNumber.value);
            if(cardNumber.value.length >= 6) {
                PagSeguroDirectPayment.getBrand({
                    cardBin: cardNumber.value.substr(0, 6),
                    success: function (res) {
                        // console.log(res);
                        let imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/42x20/${res.brand.name}.png">`
                        spanBrand.innerHTML = imgFlag;
                        document.querySelector('input[name=card_brand]').value = res.brand.name;
                        getInstallments(amountTransaction, res.brand.name);

                    },
                    error: function (err) {
                        console.log(err);
                    },
                    complete: function (res) {
                        // console.log('Complete: ', res);
                    }
                });
            }
        });

        let submitButton = document.querySelector('button.processCheckout');

        submitButton.addEventListener('click', function (event) {

            event.preventDefault();

            PagSeguroDirectPayment.createCardToken({
                cardNumber:         document.querySelector('input[name=card_number]').value,
                brand:              document.querySelector('input[name=card_brand]').value,
                cvv:                document.querySelector('input[name=card_cvv]').value,
                expirationMonth:    document.querySelector('input[name=card_month]').value,
                expirationYear:     document.querySelector('input[name=card_year]').value,
                success: function (res) {
                    console.log(res);
                    processPayment(res.card.token);
                },
                error: function (err) {
                    console.log(err);
                },
                complete: function (res) {
                    console.log('Completo card_token: ', res);
                }
            })
        });

        function processPayment(token) {

            let data = {
                card_token: token,
                hash: PagSeguroDirectPayment.getSenderHash(),
                installment: document.querySelector('select.select_installments').value,
                card_name: document.querySelector('input[name=card_name]').value,
                _token: '{{csrf_token()}}',
            };
            console.log(data);
            $.ajax({
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                type: 'POST',
                url: '{{route("checkout.process")}}',
                data: data,
                dataType: 'json',
                // contentType: "application/json; charset=utf-8",
                success: function (res) {
                    console.log(res);
                    // Display a success toast, with a title
                    toastr.success(res.data.message, 'Sucesso!');
                    // alert(res.data.message)
                    window.location.href = '{{route('checkout.thanks')}}?order=' + res.data.order;
                },
                error: function (err) {
                    console.log('AJAX: ', err);             }
            });
        }

        function getInstallments(amount, brand) {
            PagSeguroDirectPayment.getInstallments({
                amount: amount,
                brand: brand,
                maxInstallmentNoInterest: 0,
                success: function (res) {
                    // console.log(res);
                    let selectInstallments = drawSelectInstallments(res.installments[brand]);
                    document.querySelector('div.installments').innerHTML = selectInstallments;
                },
                error: function (err) {
                    console.log('Erro brand: ', err);
                },
                complete: function (res) {
                    // console.log('Complete: ', res);
                },
            })
        }

        function drawSelectInstallments(installments) {
            let select = '<label>Opções de Parcelamento:</label>';

            select += '<select class ="form-control select_installments">';

            for(let l of installments) {

                select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;

            }

            select += '</select>';

            return select;
        }
    </script>

    <script>
        var selector = document.getElementById("cpf");

        var im = new Inputmask("999.999.999-99");
        im.mask(selector);
    </script>
@endsection
