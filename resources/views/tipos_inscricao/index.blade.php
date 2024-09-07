@extends('layouts.app')

@section('content')
    <h1>Tipos de Inscrição</h1>
    
    <a href="{{ route('tipos_inscricao.create') }}" class="btn btn-primary mb-3">Novo Tipo de Inscrição</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Vagas Disponíveis</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tiposInscricao as $tipo)
                <tr>
                    <td>{{ $tipo->nome }}</td>
                    <td>{{ $tipo->numero_vagas }}</td>
                    <td>{{ $tipo->valor }}</td>
                    <td>
                        <a href="{{ route('tipos_inscricao.edit', $tipo->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('tipos_inscricao.destroy', $tipo->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection