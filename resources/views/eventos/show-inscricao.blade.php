@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h2>
                Informações do Inscrito
            </h2>
            <a href="{{ url('/eventos/' . $evento->id) }}" class="btn btn-primary">
                Voltar para evento
            </a>
        </div>
        <div class="card-body">
            <div class="row border p-2">
                <h3>Dados do inscrito</h3>
                <div class="col d-flex flex-wrap justify-content-around">
                    <p><b>Nome</b>: {{ $inscrito->nome }}</p>
                    <p><b>Idade</b>: {{ $inscrito->idade }}</p>
                    <p>
                        <b>Telefone/Whatsapp</b>:
                        @php
                            $mask = '(##) #####-####';
                        @endphp
                        {{ mask($mask, $inscrito->telefone) }}
                    </p>
                    <p><b>Email</b>: {{ $inscrito->email }}</p>
                    <p><b>Congregação</b>: {{ $inscrito->congregacao }}</p>
                </div>
            </div>
            <div class="row border mt-3 p-2">
                <h3>Dados da inscrição</h3>
                <div class="col d-flex flex-wrap justify-content-around">
                    <p>
                        <b>Tipo de inscricao</b>: {{ $inscrito->tipoInscricao->nome }}
                    </p>
                    <p>
                        <b>Valor da inscricao</b>: R$ {{ number_format($inscrito->tipoInscricao->valor, 2, ',', '.') }}
                    </p>
                    <p>
                        <b>Status</b>: {{ $inscrito->status }}
                    </p>
                    <p>
                        <b>Tipo de camisa</b>: {{ $inscrito->camisa_tipo }}
                    </p>
                    <p>
                        <b>Tamanho da Camisa</b>: {{ $inscrito->camisa_tamanho }}
                    </p>
                    
                </div>
            </div>
            <div class="row border mt-3 p-2">
                <h3>Dados de pagamento</h3>
                <div class="col d-flex flex-wrap justify-content-around">
                    <p>
                        <b>Forma de Pagamento</b>: {{ $inscrito->forma_pagamento }}
                    </p>
                    @if($inscrito->link_pagamento !== "")
                        <p>
                            <b>Link de Pagamento</b>: {{ $inscrito->link_pagamento }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row border mt-3 p-2 d-flex align-items-center">
                <div class="col-md-6 col-sm-12">
                    <form action="{{ route('inscritos.pagamento') }}" method="post">
                        @csrf
                        @method("PATCH")
                        <div class="form-group mb-3">
                            <label for="link_pagamento">Inserir Link de Pagamento</label>
                            <input type="text" class="form-control my-2" id="link_pagamento" name="link_pagamento" />
                        </div>
                        <input type="hidden" name="inscrito_id" value="{{ $inscrito->id }}">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
                @if($inscrito->status != "Aprovado")
                    <div class="col-md-6 col-sm-12 d-flex border p-2">
                        <a href="{{ route('inscritos.aprovar', $inscrito->id) }}" class="btn btn-info">Aprovar</a>
                        <a href="{{ route('inscritos.rejeitar', $inscrito->id) }}" class="btn btn-danger mx-2">Rejeitar</a>
                        @if(!$inscrito->mensagem_enviada)
                        <a href="{{$mensagem}}" class="btn btn-success" target="_blank">Enviar Mensagem</a>
                        <a href="{{ route('inscritos.confirmar', $inscrito->id) }}" class="btn btn-info mx-2">Confirmar Envio</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection