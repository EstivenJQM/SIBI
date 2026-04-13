<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empleado_contratista', function (Blueprint $table) {
            $table->unsignedInteger('id_usuario_rol_sede');
            $table->unsignedSmallInteger('id_dependencia');
            $table->unsignedSmallInteger('id_cargo')->nullable();
            $table->string('codigo_cargo', 30)->nullable();
            $table->primary('id_usuario_rol_sede');

            $table->foreign('id_usuario_rol_sede', 'fk_cont_empleado')
                  ->references('id_usuario_rol_sede')->on('empleado')
                  ->onUpdate('cascade');
            $table->foreign('id_dependencia', 'fk_cont_dep')
                  ->references('id_dependencia')->on('dependencia')
                  ->onUpdate('cascade');
            $table->foreign('id_cargo', 'fk_cont_cargo')
                  ->references('id_cargo')->on('cargo')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleado_contratista');
    }
};
