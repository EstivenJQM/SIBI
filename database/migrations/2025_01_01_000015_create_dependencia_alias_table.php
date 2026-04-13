<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dependencia_alias', function (Blueprint $table) {
            $table->increments('id_dependencia_alias');
            $table->unsignedSmallInteger('id_dependencia');
            $table->string('alias', 150)->unique('uq_dep_alias');

            $table->foreign('id_dependencia', 'fk_da_dep')
                  ->references('id_dependencia')->on('dependencia')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dependencia_alias');
    }
};
