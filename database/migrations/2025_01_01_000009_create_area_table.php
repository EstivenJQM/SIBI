<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('area', function (Blueprint $table) {
            $table->smallIncrements('id_area');
            $table->string('nombre', 150)->unique('uq_area_nom');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('area');
    }
};
