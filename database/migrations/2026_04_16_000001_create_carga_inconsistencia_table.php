<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carga_inconsistencia', function (Blueprint $table) {
            $table->id('id_inconsistencia');
            $table->unsignedSmallInteger('id_periodo')->nullable();
            $table->foreign('id_periodo')->references('id_periodo')->on('periodo')->nullOnDelete();
            $table->string('documento', 20)->default('');
            $table->string('nombres', 100)->default('');
            $table->string('apellidos', 100)->default('');
            $table->string('email', 100)->default('');
            $table->string('codigo_sede', 10)->default('');
            $table->string('nombre_sede', 100)->default('');
            $table->string('codigo_plan', 20)->default('');
            $table->string('nombre_programa', 200)->default('');
            $table->string('nombre_facultad', 200)->default('');
            $table->text('error');
            $table->unsignedSmallInteger('fila')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carga_inconsistencia');
    }
};
