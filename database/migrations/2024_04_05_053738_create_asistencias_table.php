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
        if (!Schema::hasTable('asistencias')) {
            Schema::create('asistencias', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->time('marca_entrada')->nullable();
                $table->time('marca_salida')->nullable();
                $table->boolean('omision_marca_entrada')->nullable();
                $table->boolean('omision_marca_salida')->nullable();
                $table->boolean('ausencia')->nullable();
                $table->boolean('justificada')->nullable();
                $table->date('fecha');
                $table->foreignId('id_empleado');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
