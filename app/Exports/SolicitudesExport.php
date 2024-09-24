<?php

namespace App\Exports;

use App\Models\Solicitud;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SolicitudesExport implements FromView, WithHeadings, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        $solicitudes = Solicitud::with(['user', 'proveedor']) // Assuming 'creadoPor' is the relation to User and 'proveedor' is the relation to Proveedor
            ->whereBetween('fecha', [$this->startDate, $this->endDate])
            ->get();

        return view('exports.solicitudes', [
            'solicitudes' => $solicitudes
        ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Descripción',
            'Uso',
            'Status',
            'Proveedor',
            'Analista',
            'Fecha de Creación',
        ];
    }
}
