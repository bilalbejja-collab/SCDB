<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            '#',
            'NÚMERO',
            'FECHA',
            'F. VENCIMIENTO',
            'PRODUCTO',
            'SECCIÓN',
            'RECAUDACIÓN DE CANTIDAD',
            'CANTIDAD COMISION',
            'DISCUENTO',
            'VALOR IVA',
            'IVA',
            'TOTAL',
            'ESTADO',
            'ESTADO',
            'NOTA',
            'F. PAGO',
            'F. BORRDO',
            'F. CREACIÓN',
            'F. MODIFICACIÓN'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Invoice::all();
    }
}
