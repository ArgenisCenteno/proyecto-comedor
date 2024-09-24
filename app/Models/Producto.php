<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Producto extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'nombre',
        'descripcion',
        'unidad_medida',
        'cantidad',
        'categoria_id',
        'disponible',
    ];
    public function subCategoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
   
}
