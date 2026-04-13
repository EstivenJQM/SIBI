<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipo_actividad', function (Blueprint $table) {
            $table->smallIncrements('id_tipo_actividad');
            $table->string('nombre', 150)->unique('uq_tipo_act_nombre');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_actividad');
    }
};
