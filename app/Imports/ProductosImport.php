<?php

namespace App\Imports;

use App\Models\Producto;
use App\Models\Categoria; // Asegúrate de importar el modelo Categoria
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductosImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Buscar el ID de la categoría 'ALIMENTOS'
        $categoria = Categoria::where('nombre',  $row['categoria'])->first();

        if(!$categoria){
            $categoria = new Categoria();
            $categoria->nombre = $row['categoria'];
            $categoria->status = 1;
            $categoria->save();
        };

        return new Producto([
            'nombre'        => $row['nombre'],
            'descripcion'   => $row['descripcion'],
            'aplica_iva'    => $row['aplica_iva'],
            'cantidad'      => $row['cantidad'],
            'categoria_id'  => $categoria ? $categoria->id : null, // Si no se encuentra, se asigna null
            'disponible'    => $row['disponible'],
            'unidad_medida' => $row['unidad_medida'],
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
    }
}
