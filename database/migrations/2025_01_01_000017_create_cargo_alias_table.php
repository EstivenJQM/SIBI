<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargo_alias', function (Blueprint $table) {
            $table->increments('id_cargo_alias');
            $table->unsignedSmallInteger('id_cargo');
            $table->string('alias', 150)->unique('uq_cargo_alias');

            $table->foreign('id_cargo', 'fk_ca_cargo')
                  ->references('id_cargo')->on('cargo')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargo_alias');
    }
};
