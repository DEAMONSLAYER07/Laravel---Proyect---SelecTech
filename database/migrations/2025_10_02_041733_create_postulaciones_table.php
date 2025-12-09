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
    Schema::create('postulaciones', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_usuario')->constrained('usuarios')->cascadeOnDelete();
        $table->foreignId('id_vacante')->constrained('vacantes')->cascadeOnDelete();
        $table->string('cv')->nullable();
        $table->enum('estado', ['pendiente','en revisión','aceptado','rechazado'])->default('pendiente');
        $table->timestamp('fecha_postulacion')->useCurrent();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulaciones');
    }
};
