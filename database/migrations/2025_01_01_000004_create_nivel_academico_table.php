<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nivel_academico', function (Blueprint $table) {
            $table->tinyIncrements('id_nivel');
            $table->string('nombre', 30)->unique('uq_nivel_nombre');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nivel_academico');
    }
};
