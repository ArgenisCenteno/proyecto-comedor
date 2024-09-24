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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->nullable(); 
            $table->string('telefono', 13)->nullable(); 
            $table->string('rif', 13)->nullable(); 
            $table->string('direccion', 255)->nullable();
            $table->string('estado', 30)->nullable(); 
            $table->string('area', 30)->nullable(); 
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
