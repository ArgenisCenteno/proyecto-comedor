<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariosAsignacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiarios_asignacion', function (Blueprint $table) {
            $table->id(); // Crea la columna 'id'
            $table->foreignId('proveedor_id')->constrained('proveedores')->onDelete('cascade'); // Relación con 'proveedores'
            $table->foreignId('asignacion_id')->constrained('asignacions')->onDelete('cascade'); // Relación con 'asignacions'
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beneficiarios_asignacion');
    }
}
