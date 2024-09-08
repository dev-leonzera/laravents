@extends('layouts.evento')
@section('content')
<div class="row">
    <div class="col"></div>
    <img src="{{ asset('img/' . $evento->banner) }}" alt="" srcset="">
</div>
<div class="container-xl mb-5 mt-5">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="row">
        <div class="col">
            <h1 style="text-align: center">{{ $evento->title }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="row">
                @if ($evento->data_fim)
                <h3>Data: {{ \date('d/m/Y', strtotime($evento->data_inicio)) }} à
                    {{ \date('d/m/Y', strtotime($evento->data_fim)) }}
                </h3>
                @else
                <h2>Data:</h2> {{ \date('d/m/Y', strtotime($evento->data_inicio)) }};
                @endif
            </div>
            <div class="row">
                <p>
                <h3>Local: {{ $evento->local }}</h3>
                </p>
            </div>
            <div class="row mt-5">
                <div class="description">
                    {!! $evento->description !!}
                </div>
            </div>

            <div class="row">
                <h3>Kits de inscrição</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tiposInscricao as $tipo)
                        <tr>
                            <td>{{ $tipo->nome }}</td>
                            <td>R$ {{ number_format($tipo->valor, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center">
            @if ($qnt_inscritos === $evento->capacidade)
            <a href="#" class="btn btn-secondary disabled">Inscrições Encerradas</a>
            @else
            <a href="{{ url('/evento/' . $evento->id . '/inscricao') }}" class="btn btn-success btn-pill w-25 ">Faça
                sua inscrição</a>
            @endif
        </div>
    </div>
</div>
@endsection