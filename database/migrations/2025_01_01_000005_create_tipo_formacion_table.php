<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipo_formacion', function (Blueprint $table) {
            $table->tinyIncrements('id_tipo_formacion');
            $table->unsignedTinyInteger('id_nivel');
            $table->string('nombre', 40);

            $table->unique(['id_nivel', 'nombre'], 'uq_tf_nivel_nombre');

            $table->foreign('id_nivel', 'fk_tf_nivel')
                  ->references('id_nivel')->on('nivel_academico')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_formacion');
    }
};
