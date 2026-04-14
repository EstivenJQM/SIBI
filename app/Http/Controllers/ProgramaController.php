<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use App\Models\NivelAcademico;
use App\Models\Programa;
use App\Models\Sede;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    public function index()
    {
        $programas = Programa::with([
            'facultad',
            'tipoFormacion.nivel',
            'sedes' => fn($q) => $q->orderBy('nombre'),
        ])
            ->orderBy('id_facultad')
            ->orderBy('nombre')
            ->get()
            ->groupBy('id_facultad');

        $facultades = Facultad::orderBy('nombre')->get()->keyBy('id_facultad');

        return view('programas.index', compact('programas', 'facultades'));
    }

    public function create()
    {
        $facultades   = Facultad::orderBy('nombre')->get();
        $niveles      = NivelAcademico::with(['tiposFormacion' => fn($q) => $q->orderBy('nombre')])->get();
        $sedes        = Sede::orderBy('nombre')->get();

        return view('programas.create', compact('facultades', 'niveles', 'sedes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_facultad'       => 'required|exists:facultad,id_facultad',
            'id_tipo_formacion' => 'nullable|exists:tipo_formacion,id_tipo_formacion',
            'nombre'            => 'required|string|max:150',
            'sedes'             => 'required|array|min:1',
            'sedes.*'           => 'exists:sede,id_sede',
            'codigo_snies'      => 'nullable|array',
            'codigo_snies.*'    => 'nullable|string|max:20',
        ], [
            'id_facultad.required' => 'Seleccione una facultad.',
            'id_facultad.exists'   => 'La facultad seleccionada no existe.',
            'nombre.required'      => 'El nombre del programa es obligatorio.',
            'nombre.max'           => 'El nombre no puede superar los 150 caracteres.',
            'sedes.required'       => 'Debe asociar al menos una sede.',
            'sedes.min'            => 'Debe asociar al menos una sede.',
        ]);

        $programa = Programa::create([
            'id_facultad'       => $request->id_facultad,
            'id_tipo_formacion' => $request->id_tipo_formacion,
            'nombre'            => $request->nombre,
        ]);

        $programa->sedes()->sync($this->buildSedesSync($request));

        return redirect()->route('programas.index')
            ->with('success', 'Programa creado correctamente.');
    }

    public function edit(Programa $programa)
    {
        $facultades = Facultad::orderBy('nombre')->get();
        $niveles    = NivelAcademico::with(['tiposFormacion' => fn($q) => $q->orderBy('nombre')])->get();
        $sedes      = Sede::orderBy('nombre')->get();

        $sedesPrograma = $programa->sedes->keyBy('id_sede');

        return view('programas.edit', compact('programa', 'facultades', 'niveles', 'sedes', 'sedesPrograma'));
    }

    public function update(Request $request, Programa $programa)
    {
        $request->validate([
            'id_facultad'       => 'required|exists:facultad,id_facultad',
            'id_tipo_formacion' => 'nullable|exists:tipo_formacion,id_tipo_formacion',
            'nombre'            => 'required|string|max:150',
            'sedes'             => 'required|array|min:1',
            'sedes.*'           => 'exists:sede,id_sede',
            'codigo_snies'      => 'nullable|array',
            'codigo_snies.*'    => 'nullable|string|max:20',
        ], [
            'id_facultad.required' => 'Seleccione una facultad.',
            'id_facultad.exists'   => 'La facultad seleccionada no existe.',
            'nombre.required'      => 'El nombre del programa es obligatorio.',
            'nombre.max'           => 'El nombre no puede superar los 150 caracteres.',
            'sedes.required'       => 'Debe asociar al menos una sede.',
            'sedes.min'            => 'Debe asociar al menos una sede.',
        ]);

        $programa->update([
            'id_facultad'       => $request->id_facultad,
            'id_tipo_formacion' => $request->id_tipo_formacion,
            'nombre'            => $request->nombre,
        ]);

        $programa->sedes()->sync($this->buildSedesSync($request));

        return redirect()->route('programas.index')
            ->with('success', 'Programa actualizado correctamente.');
    }

    public function destroy(Programa $programa)
    {
        $programa->sedes()->detach();
        $programa->delete();

        return redirect()->route('programas.index')
            ->with('success', 'Programa eliminado correctamente.');
    }

    /** Construye el array para sync() con el pivot codigo_snies */
    private function buildSedesSync(Request $request): array
    {
        $sync = [];
        foreach ($request->sedes as $idSede) {
            $sync[$idSede] = [
                'codigo_snies' => $request->codigo_snies[$idSede] ?? null,
            ];
        }
        return $sync;
    }
}
