<?php

namespace App\Exports;

use App\Models\Asignacion;
use Carbon\Carbon;
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
        $asignaciones = Asignacion::with('creador', 'beneficiarios')
        ->whereHas('beneficiarios', function($query) {
            $query->where('proveedor_id', $this->providerId);
        })
        ->whereBetween('fecha', [Carbon::parse($this->startDate)->startOfDay(), Carbon::parse($this->endDate)->endOfDay()])
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
