<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrecioToSolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('producto_ordenados', function (Blueprint $table) {
            $table->decimal('precio', 10, 2)->after('updated_at'); // Adjust position if needed
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
            $table->dropColumn('precio');
        });
    }
}
