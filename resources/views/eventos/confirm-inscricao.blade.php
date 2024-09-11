@extends('layouts.evento')
@section('content')

<div class="container">
    <div class="row">
        <img src="{{ asset('img/' . $evento->banner) }}" alt="" srcset="">
        <div class="col d-flex flex-column justify-content-center mt-5">
            <h2>Inscrição realizada com sucesso!</h2>
            <p>
                Aguarde enquanto processamos sua inscrição. Em breve, você também receberá uma mensagem pelo Whatsapp com as instruções para pagamento.
            </p>
            <!-- <a href="{{ $tipoInscricao->link_pagamento }}" class="btn btn-primary" target="_blank">Ir para pagamento</a> -->
        </div>
    </div>
</div>

@endsection