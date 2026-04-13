<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dependencia', function (Blueprint $table) {
            $table->smallIncrements('id_dependencia');
            $table->string('nombre', 150)->unique('uq_dep_nombre');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dependencia');
    }
};
