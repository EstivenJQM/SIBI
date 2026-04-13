<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programa', function (Blueprint $table) {
            $table->smallIncrements('id_programa');
            $table->unsignedSmallInteger('id_facultad');
            $table->unsignedTinyInteger('id_tipo_formacion')->nullable();
            $table->string('nombre', 150);
            $table->timestamps();

            $table->foreign('id_facultad', 'fk_prog_facultad')
                  ->references('id_facultad')->on('facultad')
                  ->onUpdate('cascade');
            $table->foreign('id_tipo_formacion', 'fk_prog_tipo_form')
                  ->references('id_tipo_formacion')->on('tipo_formacion')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programa');
    }
};
