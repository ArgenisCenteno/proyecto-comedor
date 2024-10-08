<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('asignacions', function (Blueprint $table) {
            $table->string('status', 50)->nullable(); // Agrega la columna 'status'
          

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asignacions', function (Blueprint $table) {
         
            $table->dropColumn('status');
        });
    }
};
