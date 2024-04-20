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
        if (!Schema::hasTable('empleados')) {
            Schema::create('empleados', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->string('nombre');
                $table->integer('cedula');
                $table->date('fecha_ingreso')->unique();
                $table->string('correo_electronico')->unique();
                $table->foreignId('id_departamento');
                $table->foreignId('id_perfil');
                $table->foreignId('id_puesto');
                $table->foreignId('id_horario');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
