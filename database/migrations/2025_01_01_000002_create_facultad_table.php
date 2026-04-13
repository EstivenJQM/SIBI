<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facultad', function (Blueprint $table) {
            $table->smallIncrements('id_facultad');
            $table->string('nombre', 150)->unique('uq_facultad_nom');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facultad');
    }
};
