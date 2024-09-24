<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductosExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    /**
     * Return a collection of all products.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Producto::select('id', 'nombre', 'descripcion', 'aplica_iva', 'cantidad', 'categoria_id', 'disponible', 'created_at', 'updated_at', 'unidad_medida')->get();
    }

    /**
     * Define the headings for the exported file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Descripción',
            'Aplica IVA',
            'Cantidad',
            'Categoría',
            'Disponible',
            'Creado en',
            'Actualizado en',
            'Unidad de Medida',
        ];
    }

    /**
     * Map each row before exporting it.
     *
     * @param  \App\Models\Producto  $producto
     * @return array
     */
    public function map($producto): array
    {
        
        return [
            $producto->id,
            $producto->nombre,
            $producto->descripcion,
            $producto->aplica_iva ? 'Sí' : 'No', // Boolean as 'Sí' or 'No'
            $producto->cantidad,
            $producto->subcategoria->nombre ?? 'N/A', // Assumes relation with Categoria model
            $producto->disponible ? 'Disponible' : 'No Disponible', // Boolean for availability
            $producto->created_at->format('d/m/Y H:i'), // Formatted creation date
            $producto->updated_at->format('d/m/Y H:i'), // Formatted update date
            $producto->unidad_medida,
        ];
    }
}
