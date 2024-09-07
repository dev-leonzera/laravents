@extends('layouts.app')

@section('content')
    <h1>Editar Tipo de Inscrição</h1>

    <form action="{{ url('/tipos_inscricao/' . $tipoInscricao->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $tipoInscricao->nome }}" required>
        </div>
        <div class="form-group">
            <label for="numero_vagas">Número de Vagas</label>
            <input type="number" class="form-control" id="numero_vagas" name="numero_vagas" value="{{ $tipoInscricao->numero_vagas }}" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao">{{ $tipoInscricao->descricao }}</textarea>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" class="form-control" id="valor" name="valor" value="{{ $tipoInscricao->valor }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
@endsection
