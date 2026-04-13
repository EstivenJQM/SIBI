<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('servicio', function (Blueprint $table) {
            $table->increments('id_servicio');
            $table->unsignedSmallInteger('id_linea');
            $table->unsignedSmallInteger('id_tipo_actividad');
            $table->string('nombre', 200);
            $table->unsignedTinyInteger('id_sede');
            $table->date('fecha');
            $table->unsignedSmallInteger('id_periodo');
            $table->timestamps();

            $table->index('id_periodo', 'idx_serv_periodo');
            $table->index('fecha', 'idx_serv_fecha');
            $table->index('id_sede', 'idx_serv_sede');
            $table->index('nombre', 'idx_serv_nombre');

            // FK compuesta: solo a linea_tipo_actividad
            $table->foreign(['id_linea', 'id_tipo_actividad'], 'fk_serv_lta')
                  ->references(['id_linea', 'id_tipo_actividad'])
                  ->on('linea_tipo_actividad')
                  ->onUpdate('cascade');
            $table->foreign('id_sede', 'fk_serv_sede')
                  ->references('id_sede')->on('sede')
                  ->onUpdate('cascade');
            $table->foreign('id_periodo', 'fk_serv_periodo')
                  ->references('id_periodo')->on('periodo')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicio');
    }
};
