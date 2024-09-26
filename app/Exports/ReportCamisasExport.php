<?php

namespace App\Exports;

use App\Models\Inscrito;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportCamisasExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $evento_id;

    public function __construct($evento_id)
    {
        $this->evento_id = $evento_id;
    }

    /**
     * @return \Illuminate\Support\Collection
    
     */

    public function headings(): array
    {
        return [
            'Nome',
            'Tipo da Camisa',
            'Tamanho da Camisa',
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
        $query = Inscrito::where('evento_id', $this->evento_id)
            ->select('nome', 'camisa_tipo', 'camisa_tamanho')
            ->distinct();
        return $query->get();
    }
}
