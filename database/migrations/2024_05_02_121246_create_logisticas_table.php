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
        Schema::create('logisticas', function (Blueprint $table) {
            $table->id();
            $table->string('placa');
            $table->dateTime('fecha');
            $table->integer('Valor');
            $table->boolean('finalizado');
            $table->foreignId('actividads');
            $table->foreignId('motivos');
            $table->foreignId('empresas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logisticas');
    }
};
