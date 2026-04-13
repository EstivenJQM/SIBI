<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('nivel_academico')->insert([
            ['nombre' => 'Pregrado'],
            ['nombre' => 'Postgrado'],
        ]);

        DB::table('tipo_formacion')->insert([
            ['id_nivel' => 1, 'nombre' => 'Técnica'],
            ['id_nivel' => 1, 'nombre' => 'Tecnológica'],
            ['id_nivel' => 1, 'nombre' => 'Profesional'],
            ['id_nivel' => 2, 'nombre' => 'Especialización'],
            ['id_nivel' => 2, 'nombre' => 'Maestría'],
            ['id_nivel' => 2, 'nombre' => 'Doctorado'],
        ]);

        DB::table('rol')->insert([
            ['nombre' => 'Estudiante'],
            ['nombre' => 'Graduado'],
            ['nombre' => 'Empleado'],
            ['nombre' => 'Familiar'],
        ]);

        DB::table('tipo_empleado')->insert([
            ['nombre' => 'Administrativo'],
            ['nombre' => 'Docente'],
            ['nombre' => 'Contratista'],
        ]);

        DB::table('tipo_contrato')->insert([
            ['nombre' => 'Planta'],
            ['nombre' => 'Cátedra'],
        ]);
    }

    public function down(): void
    {
        DB::table('tipo_contrato')->truncate();
        DB::table('tipo_empleado')->truncate();
        DB::table('rol')->truncate();
        DB::table('tipo_formacion')->truncate();
        DB::table('nivel_academico')->truncate();
    }
};
