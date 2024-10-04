@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>
                    {{ $evento->title }}
                </h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <b>Local do evento:</b> {{ $evento->local }}
                        </div>
                        <div class="mb-3">
                            @if ($evento->data_fim)
                            <b>Data do Evento:</b> {{ \date("d/m/Y", strtotime($evento->data_inicio)) }} à {{ \date("d/m/Y", strtotime($evento->data_fim)) }}
                            @else
                            <b>Data do Evento:</b> {{ \date("d/m/Y", strtotime($evento->data_inicio)) }};
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 d-flex justify-content-end">
                            <a href="{{ url('/evento/'.$evento->slug) }}" target="_blank" class="btn btn-primary">Link para a página do evento</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <h3>Descrição do Evento</h3>
                            <p>{!! $evento->description !!}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h3>Números do Evento</h3>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <span>Total de Vendas</span>
                                <h3>R$ {{number_format($somaValoresTiposInscricao, 2, ',', '.')}}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <span>Número de inscritos</span>
                                <h3>{{ $evento->countInscritos() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <h2>Lista de Inscritos</h2>
                    <form action="{{ route('eventos.show', $evento->id) }}" method="GET" class="mb-3">
                        <div class="row">
                            <div class="col-md-2">
                                <input type="text" name="inscrito" id="" class="form-control" placeholder="Nome do inscrito">
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-control">
                                    <option value="">Todos os status</option>
                                    <option value="Aprovado" {{ request('status') == 'Aprovado' ? 'selected' : '' }}>Aprovado</option>
                                    <option value="Rejeitado" {{ request('status') == 'Rejeitado' ? 'selected' : '' }}>Rejeitado</option>
                                    <option value="Pendente" {{ request('status') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="tipo_inscricao" class="form-control">
                                    <option value="">Todos os tipos</option>
                                    @foreach($tiposInscricao as $tipo)
                                    <option value="{{ $tipo->nome }}" {{ request('tipo_inscricao') == $tipo->nome ? 'selected' : '' }}>{{ $tipo->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="congregacao" class="form-control">
                                    <option value="">Todos</option>
                                    @foreach($congregacoes as $congregacao)
                                        <option value="{{ $congregacao }}" {{ request('congregacao') == $congregacao ? 'selected' : '' }}>{{ $congregacao }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="mensagem_enviada" class="form-control">
                                    <option value="">Mensagem Enviada</option>
                                    <option value="1" {{ request('mensagem_enviada') == "1" ? 'selected' : ''}}>Sim</option>
                                    <option value="0" {{ request('mensagem_enviada') == "0" ? 'selected' : ''}}>Não</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                                <a href="{{ route('inscritos.export', ['evento_id' => $evento->id] + request()->all()) }}" class="btn btn-success">Exportar</a>
                            </div>
                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <th>Nome</th>
                            <th>Congregação</th>
                            <th>Idade</th>
                            <th>Forma de Pagamento</th>
                            <th>Tipo de Inscrição</th>
                            <th>Status Inscrição</th>
                            <th>Mensagem Enviada</th>
                            <th>Ações</th>
                        </thead>
                        <tbody>
                            @foreach ($inscritos as $inscrito)
                            @if($inscrito->status !== "Rejeitado")
                            <tr>
                                <td>
                                    {{ $inscrito->nome }}
                                </td>
                                <td>
                                    {{ $inscrito->congregacao }}
                                </td>
                                <td>
                                    {{ $inscrito->idade }}
                                </td>
                                <td>
                                    {{$inscrito->forma_pagamento}}
                                </td>
                                <td>
                                    {{ $inscrito->tipoInscricao->nome }}
                                </td>
                                <td>
                                    {{ $inscrito->status }}
                                </td>
                                <td>
                                    {{ $inscrito->mensagem_enviada ? "Sim" : "Não" }}
                                </td>
                                <td>
                                    <a href="{{ route('inscritos.visualizar', $inscrito->id)}}" class="btn btn-success">Visualizar Inscrição</a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection