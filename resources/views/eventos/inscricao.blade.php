@extends('layouts.evento')

@section('content')
<div class="container-xl">
    <form class="card card-md" action="{{ url('evento/form') }}" method="post" autocomplete="off">
        @csrf
        <div class="card-header">
            <h1 class="text-center">{{ $evento->title }}</h1>
        </div>
        <div class="card-body">
            <input type="hidden" name="evento_id" value="{{ $evento->id }}">
            
            @foreach(['nome' => 'Nome completo', 'idade' => 'Idade', 'telefone' => 'Telefone', 'email' => 'Email', 'congregacao' => 'Congregação'] as $field => $label)
                <div class="mb-3">
                    <label class="form-label">{{ __($label) }}</label>
                    <input type="{{ $field == 'email' ? 'email' : ($field == 'idade' ? 'number' : 'text') }}"
                           name="{{ $field }}"
                           class="form-control @error($field) is-invalid @enderror"
                           placeholder="{{ __($label) }}"
                           value="{{ old($field) }}"
                           required>
                    @error($field)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach

            <div class="mb-3">
                <label class="form-label">{{ __('Tipo de Inscrição') }}</label>
                <select name="tipos_inscricao_id" class="form-select @error('tipos_inscricao_id') is-invalid @enderror" required>
                    <option value="">Selecione o tipo de inscrição</option>
                    @foreach($tipos_inscricao as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('tipos_inscricao_id') == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nome }}
                        </option>
                    @endforeach
                </select>
                @error('tipos_inscricao_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">{{ __('Enviar inscrição') }}</button>
            </div>
        </div>
    </form>
</div>
@endsection