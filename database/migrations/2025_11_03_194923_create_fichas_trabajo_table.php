<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('fichas_trabajo', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_postulante');
            $table->foreign('id_postulante')->references('id')->on('usuarios')->onDelete('cascade');
            $table->string('area')->comment('Área en la que ha trabajado');
            $table->integer('experiencia')->comment('Años de experiencia');
            
            $table->boolean('carta_recomendacion')->default(false)->comment('1 = Sí, 0 = No');
            $table->string('archivo_carta')->nullable()->comment('Ruta del archivo de la carta si aplica');

            $table->text('observaciones')->nullable();

            $table->string('estado')->default('Pendiente');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fichas_trabajo');
    }
};
