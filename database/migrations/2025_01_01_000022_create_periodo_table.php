<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periodo', function (Blueprint $table) {
            $table->smallIncrements('id_periodo');
            $table->char('nombre', 6)->unique('uq_periodo_nombre')
                  ->comment('Formato YYYY-S (ej: 2025-1)');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `periodo` ADD CONSTRAINT `ck_periodo_formato` CHECK (`nombre` REGEXP '^[0-9]{4}-[12]$')");
    }

    public function down(): void
    {
        Schema::dropIfExists('periodo');
    }
};
