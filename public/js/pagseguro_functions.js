function processPayment(token) {

    let data = {
        card_token: token,
        hash: PagSeguroDirectPayment.getSenderHash(),
        installment: document.querySelector('select.select_installments').value,
        card_name: document.querySelector('input[name=card_name]').value,
        _token: csrfToken,
    };
    console.log(data);
    $.ajax({
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        type: 'POST',
        url: urlProcess,
        data: data,
        dataType: 'json',
        // contentType: "application/json; charset=utf-8",
        success: function (res) {
            console.log(res);
            // Display a success toast, with a title
            toastr.success(res.data.message, 'Sucesso!');
            // alert(res.data.message)
            window.location.href = urlThanks + '?order=' + res.data.order;
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
