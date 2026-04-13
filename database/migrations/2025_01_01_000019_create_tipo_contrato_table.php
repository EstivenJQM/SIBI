<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipo_contrato', function (Blueprint $table) {
            $table->tinyIncrements('id_tipo_contrato');
            $table->string('nombre', 30)->unique('uq_tc_nombre');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_contrato');
    }
};
