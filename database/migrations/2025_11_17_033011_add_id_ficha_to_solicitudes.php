<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            //$table->unsignedBigInteger('id_ficha')->nullable()->after('id_usuario');
            $table->unsignedBigInteger('id_ficha')->nullable()->after('id');

            $table->foreign('id_ficha')
                ->references('id')
                ->on('fichas_trabajo')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropForeign(['id_ficha']);
            $table->dropColumn('id_ficha');
        });
    }
};
