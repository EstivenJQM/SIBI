<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_estudio', function (Blueprint $table) {
            $table->smallIncrements('id_plan_estudio');
            $table->unsignedSmallInteger('id_programa_sede');
            $table->string('codigo_plan', 20);
            $table->timestamps();

            $table->unique(['id_programa_sede', 'codigo_plan'], 'uq_plan_prog_sede');

            $table->foreign('id_programa_sede', 'fk_pe_programa_sede')
                  ->references('id_programa_sede')->on('programa_sede')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_estudio');
    }
};
