<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMontoToProductoOrdenadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('producto_ordenados', function (Blueprint $table) {
            $table->decimal('monto', 10, 2)->nullable(); // Adjust the position and constraints as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producto_ordenados', function (Blueprint $table) {
            $table->dropColumn('monto');
        });
    }
}
