<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('proveedores', function (Blueprint $table) {
            $table->string('tip', 20)->default('ENTRADA');  // Agregamos el campo 'tip' con valor por defecto 'ENTRADA'
        });
    }

    /**
     * Revertir la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proveedores', function (Blueprint $table) {
            $table->dropColumn('tip');  // Elimina el campo 'tip' si se revierte la migración
        });
    }
};
