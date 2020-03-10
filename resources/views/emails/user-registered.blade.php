<h1>Olá, {{$user->name}}!</h1>

<h3>Obrigado por sua inscrição!</h3>

<p>
    Faça bom proveito e excelentes compras em nosso marketplace!<br>
    Seu e-mail de cadastro é: <strong>{{$user->email}}</strong>
</p>

<hr>
Email enviado em {{date('d/m/Y H:i:s')}}
