@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tipos de Inscrição</h1>
        
        <div class="mb-3">
            <a href="{{ route('tipos_inscricao.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Novo Tipo de Inscrição
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
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
                                    <td>R$ {{ number_format($tipo->valor, 2, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('tipos_inscricao.edit', $tipo->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                        <form action="{{ route('tipos_inscricao.destroy', $tipo->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
                                                <i class="bi bi-trash"></i> Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection