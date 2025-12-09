<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fichas_trabajo', function (Blueprint $table) {
            $table->string('titulo')->nullable();
            $table->string('empresa')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('modalidad')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('salario')->nullable();
        });
    }

    public function down()
    {
        Schema::table('fichas_trabajo', function (Blueprint $table) {
            $table->dropColumn([
                'titulo',
                'empresa',
                'ciudad',
                'modalidad',
                'descripcion',
                'salario'
            ]);
        });
    }
};
