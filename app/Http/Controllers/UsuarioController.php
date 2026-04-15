<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $soloEstudiantes = $request->boolean('solo_estudiantes');
        $busqueda        = trim($request->get('q', ''));

        // Relaciones base para todos los usuarios
        $with = [
            'rolesEnSedes.rol',
            'rolesEnSedes.sede',
            'rolesEnSedes.periodo',
        ];

        // En modo estudiante añadimos toda la cadena académica
        if ($soloEstudiantes) {
            $with[] = 'rolesEnSedes.estudianteEgresado.planEstudio.programaSede.programa.facultad';
        }

        $query = Usuario::with($with);

        // Filtrar sólo usuarios con rol Estudiante
        if ($soloEstudiantes) {
            $query->whereHas('rolesEnSedes.rol', fn($q) => $q->where('nombre', 'Estudiante'));
        }

        // Búsqueda por nombre, apellido, documento o correo
        if ($busqueda !== '') {
            $query->where(fn($q) => $q
                ->where('documento',        'like', "%{$busqueda}%")
                ->orWhere('primer_nombre',   'like', "%{$busqueda}%")
                ->orWhere('segundo_nombre',  'like', "%{$busqueda}%")
                ->orWhere('primer_apellido', 'like', "%{$busqueda}%")
                ->orWhere('segundo_apellido','like', "%{$busqueda}%")
                ->orWhere('correo',          'like', "%{$busqueda}%")
            );
        }

        $usuarios = $query
            ->orderBy('primer_apellido')
            ->orderBy('primer_nombre')
            ->paginate(30)
            ->withQueryString();

        return view('usuarios.index', compact('usuarios', 'soloEstudiantes', 'busqueda'));
    }
}
