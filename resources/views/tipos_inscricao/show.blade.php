@extends('layouts.app')

@section('content')
    <h1>Detalhes do Tipo de Inscrição</h1>

    <dl class="row">
        <dt class="col-sm-3">ID</dt>
        <dd class="col-sm-9">{{ $tipoInscricao->id }}</dd>

        <dt class="col-sm-3">Nome</dt>
        <dd class="col-sm-9">{{ $tipoInscricao->nome }}</dd>

        <dt class="col-sm-3">Número de Vagas</dt>
        <dd class="col-sm-9">{{ $tipoInscricao->numero_vagas }}</dd>

        <dt class="col-sm-3">Valor</dt>
        <dd class="col-sm-9">{{ $tipoInscricao->valor }}</dd>

        <dt class="col-sm-3">Criado em</dt>
        <dd class="col-sm-9">{{ $tipoInscricao->created_at->format('d/m/Y H:i:s') }}</dd>

        <dt class="col-sm-3">Atualizado em</dt>
        <dd class="col-sm-9">{{ $tipoInscricao->updated_at->format('d/m/Y H:i:s') }}</dd>
    </dl>

    <a href="{{ route('tipos_inscricao.edit', $tipoInscricao->id) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('tipos_inscricao.index') }}" class="btn btn-secondary">Voltar</a>
@endsection
