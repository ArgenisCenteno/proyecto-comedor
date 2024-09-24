<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiarioAsignacion extends Model
{
    use HasFactory;

    // Definir la tabla si el nombre no sigue la convención
    protected $table = 'beneficiarios_asignacion';

    // Definir los atributos que son asignables en masa
    protected $fillable = [
        'proveedor_id',
        'asignacion_id',
    ];

    // Definir las relaciones
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class);
    }
}
