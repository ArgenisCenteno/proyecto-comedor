<?php

namespace App\Imports;

use App\Models\Proveedor;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProveedoresImport implements ToModel, WithHeadingRow, ShouldAutoSize
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Verifica si ya existe un proveedor con el mismo RIF
        $existingProveedor = Proveedor::where('rif', $row['rif'])->first();

        if ($existingProveedor) {
            // Si ya existe un proveedor con el RIF, no lo agrega
            return null;
        }

        // Si no existe, lo crea
        return new Proveedor([
            'razon_social' => $row['razon_social'],
            'telefono'     => $row['telefono'],
            'email'        => $row['email'],
            'estado'       => $row['estado'],
            'municipio'    => $row['municipio'],
            'parroquia'    => $row['parroquia'],
            'rif'          => $row['rif'],
        ]);
    }
}
