<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('linea', function (Blueprint $table) {
            $table->smallIncrements('id_linea');
            $table->unsignedSmallInteger('id_componente');
            $table->string('nombre', 150);
            $table->timestamps();

            $table->unique(['id_componente', 'nombre'], 'uq_linea_comp_nom');

            $table->foreign('id_componente', 'fk_linea_comp')
                  ->references('id_componente')->on('componente')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('linea');
    }
};
