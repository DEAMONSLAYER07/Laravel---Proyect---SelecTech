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
    Schema::create('perfiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_usuario')->constrained('usuarios')->cascadeOnDelete();
        $table->string('telefono', 20)->nullable();
        $table->string('direccion', 255)->nullable();   // <--- ESTA FALTABA
        $table->text('experiencia')->nullable();
        $table->text('educacion')->nullable();
        $table->text('habilidades')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfiles');
    }
};
