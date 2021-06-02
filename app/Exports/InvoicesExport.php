<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements WithDrawings, FromCollection, WithHeadings
{
    /**
     * Añade el logo al excel
     */
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setPath(public_path('/assets/img/brand/logo.png'));
        $drawing->setCoordinates('V1');
        return $drawing;
    }

    /**
     * Cabecera del excel
     */
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
