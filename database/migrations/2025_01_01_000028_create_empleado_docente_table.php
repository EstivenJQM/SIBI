<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empleado_docente', function (Blueprint $table) {
            $table->unsignedInteger('id_usuario_rol_sede');
            $table->unsignedTinyInteger('id_tipo_contrato');
            $table->unsignedSmallInteger('id_programa_sede');
            $table->primary('id_usuario_rol_sede');

            $table->foreign('id_usuario_rol_sede', 'fk_doc_empleado')
                  ->references('id_usuario_rol_sede')->on('empleado')
                  ->onUpdate('cascade');
            $table->foreign('id_tipo_contrato', 'fk_doc_contrato')
                  ->references('id_tipo_contrato')->on('tipo_contrato')
                  ->onUpdate('cascade');
            $table->foreign('id_programa_sede', 'fk_doc_prog_sede')
                  ->references('id_programa_sede')->on('programa_sede')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleado_docente');
    }
};
