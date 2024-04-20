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
        if (!Schema::hasTable('evaluacions')) {
            Schema::create('evaluacions', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->foreignId('user_id');
                $table->string('pregunta')->nullable();
                $table->integer('puntuacion');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacions');
    }
};
