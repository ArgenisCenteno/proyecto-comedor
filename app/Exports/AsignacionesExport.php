<?php

namespace App\Exports;

use App\Models\Asignacion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AsignacionesExport implements FromView, WithHeadings, ShouldAutoSize
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
        $asignaciones = Asignacion::with('creador', 'beneficiarios')  // Include 'beneficiarios' relationship
        ->whereHas('beneficiarios', function($query) {
            $query->where('proveedor_id', $this->providerId);  // Filter by proveedor_id in BeneficiarioAsignacion
        })
        ->whereBetween('fecha', [$this->startDate, $this->endDate])
        ->get();

        return view('exports.asignaciones', [
            'asignaciones' => $asignaciones
        ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tipo',
            'Fecha',
            'Descripción',
            'Creado Por',
            'Status',
            'Fecha de Creación',
            'Fecha de Actualización',
        ];
    }
}
