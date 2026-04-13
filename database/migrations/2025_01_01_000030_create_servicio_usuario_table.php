<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicio_usuario', function (Blueprint $table) {
            $table->unsignedInteger('id_servicio');
            $table->unsignedInteger('id_usuario_rol_sede');
            $table->primary(['id_servicio', 'id_usuario_rol_sede']);
            $table->timestamps();

            $table->index('id_usuario_rol_sede', 'idx_su_urs');

            $table->foreign('id_servicio', 'fk_su_servicio')
                  ->references('id_servicio')->on('servicio')
                  ->onUpdate('cascade');
            $table->foreign('id_usuario_rol_sede', 'fk_su_urs')
                  ->references('id_usuario_rol_sede')->on('usuario_rol_sede')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicio_usuario');
    }
};
