@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Relatórios
                        </h2>
                    </div>
                    <div class="col-auto ms-auto d-print-none">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div class="row py-5">
                        <div class="col d-flex justify-content-between align-items-center border p-3">
                            <span>Geral</span>
                            <a href="#" class="btn btn-primary">Exportar</a>
                        </div>
                        <div class="col border flex-column py-2">
                            <span>Camisas</span>
                            <form id="report-form" action="{{ url('reports/camisas') }}" method="GET">

                                <select class="form-control my-2" id="evento" name="evento_id">
                                    <option value="">Selecione o evento</option>
                                    @foreach ($eventos as $evento)
                                        <option value="{{ $evento->id }}">{{ $evento->title }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Exportar</button>

                            </form>
                            <script>
                                document.getElementById('evento').addEventListener('change', function() {
                                    const eventId = this.value;
                                    const form = document.getElementById('report-form');
                                    form.action = `{{ route('reports.camisas', '') }}/${eventId}`;
                                });
                            </script>
                        </div>
                        <div class="col d-flex justify-content-between align-items-center border p-3">
                            <span>Pendentes</span>
                            <a href="#" class="btn btn-primary">Exportar</a>
                        </div>
                        <div class="col d-flex justify-content-between align-items-center border p-3">
                            <span>Aprovados</span>
                            <a href="#" class="btn btn-primary">Exportar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>>
@endsection
