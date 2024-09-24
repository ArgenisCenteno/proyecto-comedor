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

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        $asignaciones = Asignacion::with('creador') // Assuming 'creador' is the relation to User
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
