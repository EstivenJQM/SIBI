<?php

namespace App\Services;

use App\Models\Servicio;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class CargaServicioUsuariosService
{
    private const PRIORIDAD_ROLES = ['Estudiante', 'Graduado', 'Empleado', 'Familiar'];

    public function asignar(UploadedFile $archivo, Servicio $servicio): array
    {
        $contenido = file_get_contents($archivo->getRealPath());
        $contenido = ltrim($contenido, "\xEF\xBB\xBF");

        $cedulas = array_values(array_filter(
            array_map('trim', preg_split('/[\r\n]+/', $contenido))
        ));

        $asignados     = 0;
        $yaExistian    = 0;
        $noEncontrados = [];
        $sinRol        = [];

        foreach ($cedulas as $cedula) {
            $usuario = DB::table('usuario')->where('documento', $cedula)->first();

            if (! $usuario) {
                $noEncontrados[] = $cedula;
                continue;
            }

            $candidatos = DB::table('usuario_rol_sede as urs')
                ->join('rol', 'urs.id_rol', '=', 'rol.id_rol')
                ->where('urs.id_usuario', $usuario->id_usuario)
                ->where('urs.id_sede',    $servicio->id_sede)
                ->where('urs.id_periodo', $servicio->id_periodo)
                ->where('urs.estado',     'activo')
                ->select('urs.id_usuario_rol_sede', 'rol.nombre as nombre_rol')
                ->get();

            if ($candidatos->isEmpty()) {
                $nombre        = trim("{$usuario->primer_nombre} {$usuario->primer_apellido}");
                $sinRol[]      = "{$cedula} — {$nombre}";
                continue;
            }

            $idUrs = $this->seleccionarUrs($candidatos);

            $existe = DB::table('servicio_usuario')
                ->where('id_servicio',         $servicio->id_servicio)
                ->where('id_usuario_rol_sede',  $idUrs)
                ->exists();

            if ($existe) {
                $yaExistian++;
                continue;
            }

            DB::table('servicio_usuario')->insert([
                'id_servicio'         => $servicio->id_servicio,
                'id_usuario_rol_sede' => $idUrs,
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);

            $asignados++;
        }

        return [
            'asignados'     => $asignados,
            'ya_existian'   => $yaExistian,
            'no_encontrados'=> $noEncontrados,
            'sin_rol'       => $sinRol,
            'total'         => count($cedulas),
        ];
    }

    private function seleccionarUrs($candidatos): int
    {
        foreach (self::PRIORIDAD_ROLES as $rol) {
            $match = $candidatos->firstWhere('nombre_rol', $rol);
            if ($match) return $match->id_usuario_rol_sede;
        }
        return $candidatos->first()->id_usuario_rol_sede;
    }
}
