<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sede', function (Blueprint $table) {
            $table->tinyIncrements('id_sede');
            $table->string('codigo', 10)->unique('uq_sede_codigo');
            $table->string('nombre', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sede');
    }
};
