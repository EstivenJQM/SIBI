<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estudiante_egresado', function (Blueprint $table) {
            $table->unsignedInteger('id_usuario_rol_sede');
            $table->unsignedSmallInteger('id_plan_estudio');
            $table->primary('id_usuario_rol_sede');

            $table->foreign('id_usuario_rol_sede', 'fk_ee_urs')
                  ->references('id_usuario_rol_sede')->on('usuario_rol_sede')
                  ->onUpdate('cascade');
            $table->foreign('id_plan_estudio', 'fk_ee_plan')
                  ->references('id_plan_estudio')->on('plan_estudio')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estudiante_egresado');
    }
};
