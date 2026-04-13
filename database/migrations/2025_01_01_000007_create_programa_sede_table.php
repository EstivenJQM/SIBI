<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programa_sede', function (Blueprint $table) {
            $table->smallIncrements('id_programa_sede');
            $table->unsignedSmallInteger('id_programa');
            $table->unsignedTinyInteger('id_sede');
            $table->string('codigo_snies', 20)->nullable();
            $table->timestamps();

            $table->unique(['id_programa', 'id_sede'], 'uq_programa_sede');

            $table->foreign('id_programa', 'fk_ps_programa')
                  ->references('id_programa')->on('programa')
                  ->onUpdate('cascade');
            $table->foreign('id_sede', 'fk_ps_sede')
                  ->references('id_sede')->on('sede')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programa_sede');
    }
};
