<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('componente', function (Blueprint $table) {
            $table->smallIncrements('id_componente');
            $table->unsignedSmallInteger('id_area');
            $table->string('nombre', 150);
            $table->timestamps();

            $table->unique(['id_area', 'nombre'], 'uq_comp_area_nom');

            $table->foreign('id_area', 'fk_comp_area')
                  ->references('id_area')->on('area')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('componente');
    }
};
