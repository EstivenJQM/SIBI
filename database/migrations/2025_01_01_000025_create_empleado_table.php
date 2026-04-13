<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->unsignedInteger('id_usuario_rol_sede');
            $table->unsignedTinyInteger('id_tipo_empleado');
            $table->primary('id_usuario_rol_sede');

            $table->foreign('id_usuario_rol_sede', 'fk_emp_urs')
                  ->references('id_usuario_rol_sede')->on('usuario_rol_sede')
                  ->onUpdate('cascade');
            $table->foreign('id_tipo_empleado', 'fk_emp_tipo')
                  ->references('id_tipo_empleado')->on('tipo_empleado')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleado');
    }
};
