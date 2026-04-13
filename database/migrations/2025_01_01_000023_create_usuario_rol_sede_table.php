<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario_rol_sede', function (Blueprint $table) {
            $table->increments('id_usuario_rol_sede');
            $table->unsignedInteger('id_usuario');
            $table->unsignedTinyInteger('id_rol');
            $table->unsignedTinyInteger('id_sede');
            $table->unsignedSmallInteger('id_periodo');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->timestamps();

            $table->unique(
                ['id_usuario', 'id_rol', 'id_sede', 'id_periodo'],
                'uq_urs'
            );

            $table->index('id_usuario', 'idx_urs_usuario');
            $table->index('id_rol', 'idx_urs_rol');
            $table->index('estado', 'idx_urs_estado');
            $table->index('id_periodo', 'idx_urs_periodo');
            $table->index(['id_usuario', 'estado'], 'idx_urs_usuario_estado');

            $table->foreign('id_usuario', 'fk_urs_usuario')
                  ->references('id_usuario')->on('usuario')
                  ->onUpdate('cascade');
            $table->foreign('id_rol', 'fk_urs_rol')
                  ->references('id_rol')->on('rol')
                  ->onUpdate('cascade');
            $table->foreign('id_sede', 'fk_urs_sede')
                  ->references('id_sede')->on('sede')
                  ->onUpdate('cascade');
            $table->foreign('id_periodo', 'fk_urs_periodo')
                  ->references('id_periodo')->on('periodo')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario_rol_sede');
    }
};
