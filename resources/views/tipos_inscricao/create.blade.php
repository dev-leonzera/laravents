@extends('layouts.app')

@section('content')
    <h1>Criar Novo Tipo de Inscrição</h1>

    <form action="{{ route('tipos_inscricao.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" required>
        </div>
        <div class="form-group">
            <label for="numero_vagas">Número de Vagas</label>
            <input type="number" class="form-control" id="numero_vagas" name="numero_vagas" required>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <input type="number" class="form-control" id="valor" name="valor" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection
