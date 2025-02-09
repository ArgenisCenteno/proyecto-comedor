<?php

namespace App\Exports;

use App\Models\Proveedor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProveedoresExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

     protected $tipo;

     public function __construct($tipo)
     {
         $this->tipo = $tipo;
     }
  

    public function collection()
    {
        return Proveedor::select('id', 'razon_social', 'telefono', 'email', 'estado', 'municipio', 'parroquia', 'rif')->where('tip', '=', $this->tipo)->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Razón Social',
            'Teléfono',
            'Email',
            'Estado',
            'Municipio',
            'Parroquia',
            'RIF',
        ];
    }
}
