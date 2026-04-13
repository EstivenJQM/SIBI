<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->string('documento', 20)->unique('uq_usuario_doc');
            $table->string('primer_nombre', 60);
            $table->string('segundo_nombre', 60)->nullable();
            $table->string('primer_apellido', 60);
            $table->string('segundo_apellido', 60)->nullable();
            $table->string('correo', 150);
            $table->timestamps();

            $table->index('correo', 'idx_usuario_correo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
