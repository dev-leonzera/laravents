<?php

namespace App\Exports;

use App\Models\Inscrito;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class InscritosExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $evento_id;
    protected $filters;

    public function __construct($evento_id, $filters = [])
    {
        $this->evento_id = $evento_id;
        $this->filters = $filters;
    }

    /**
    * @return \Illuminate\Support\Collection
    
    */

    public function headings(): array
    {
        return [
            'Nome',
            'Tipo de Inscrição',
            'Idade',
            'Email',
            'Telefone',
            'Data de Inscrição',
            'Congregação',
            'Status',
            'Tipo da Camisa',
            'Tamanho da Camisa',
            'Link de pagamento',
            'Link enviado'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            
            1    => ['font' => ['bold' => true]]
        ];
    }

    public function collection()
    {
        $query = Inscrito::with('tipoInscricao')
            ->where('evento_id', $this->evento_id);

        if (isset($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        if (isset($this->filters['tipo_inscricao'])) {
            $query->whereHas('tipoInscricao', function ($q) {
                $q->where('nome', $this->filters['tipo_inscricao']);
            });
        }

        // Adicione mais filtros conforme necessário

        return $query->get()
            ->map(function ($inscrito) {
                return [
                    $inscrito->nome,
                    $inscrito->tipoInscricao->nome,
                    $inscrito->idade,
                    $inscrito->email,
                    $inscrito->telefone,
                    Carbon::parse($inscrito->created_at)->format('d/m/Y'),
                    $inscrito->congregacao,
                    $inscrito->camisa_tipo,
                    $inscrito->camisa_tamanho,
                    $inscrito->status,
                    $inscrito->link_pagamento,
                    $inscrito->mensagem_enviada ? "Sim" : "Não"
                ];
            });
    }

    
}
