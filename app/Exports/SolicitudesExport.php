<?php

namespace App\Exports;

use App\Models\Solicitud;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SolicitudesExport implements FromView, WithHeadings, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;
    protected $providerId;

    public function __construct($startDate, $endDate, $providerId)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->providerId = $providerId;
    }
 
    public function view(): View
    {
        $solicitudes = Solicitud::with(['user', 'proveedor'])
        ->where('proveedor_id', $this->providerId)
        ->whereBetween('fecha', [
            Carbon::parse($this->startDate)->startOfDay(),
            Carbon::parse($this->endDate)->endOfDay()
        ])
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
