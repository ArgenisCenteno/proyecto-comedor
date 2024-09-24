<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoToAsignacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asignacions', function (Blueprint $table) {
            $table->string('tipo')->after('id')->nullable(); // Agrega el campo 'tipo' después del campo 'id'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asignacions', function (Blueprint $table) {
            $table->dropColumn('tipo'); // Elimina el campo 'tipo' si se hace rollback
        });
    }
}
