<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargo', function (Blueprint $table) {
            $table->smallIncrements('id_cargo');
            $table->string('nombre', 150)->unique('uq_cargo_nombre');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargo');
    }
};
