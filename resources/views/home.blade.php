@extends('layouts.app')

@section('custom_styles')
@endsection

@section('content')
<div class="page-body">
    <div class="container-xl">

        <div class="alert alert-success">
            <div class="alert-title">
                {{ __('Bem vindo ao Laravents, ') }} {{ auth()->user()->name ?? null }}
            </div>
        </div>
        <div class="row row-cards">
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Total de Eventos</div>
                        </div>
                        <div class="h1 mb-3">{{ $eventos }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader"></div>
                        </div>
                        <div class="h1 mb-3"></div>
                    </div>
                </div>
            </div>
            <!-- Novo card para o evento mais próximo -->
            <div class="col-sm-6 col-lg-6">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="subheader">Próximo Evento</div>
                        </div>
                        @if($proximoEvento)
                        <div class="row">
                            <a href="{{ route('eventos.show', $proximoEvento->id) }}">
                                <h3>{{ $proximoEvento->title }}</h3>
                            </a>
                            <p class="mb-0">Data: {{ \Carbon\Carbon::parse($proximoEvento->data_inicio)->format('d/m/Y') }}</p>
                        </div>
                        <div class="row my-2">
                            <div class="card">
                                <div class="d-flex align-items-center">
                                    <div class="subheader">Total de Inscritos</div>
                                </div>
                                <div class="h1 mb-3">{{ $inscritos }}</div>
                            </div>
                        </div>

                        @else
                        <p class="mb-0">Nenhum evento próximo.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection