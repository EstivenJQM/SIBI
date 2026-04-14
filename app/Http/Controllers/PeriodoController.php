<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function index()
    {
        $periodos = Periodo::orderByDesc('nombre')->get();

        return view('periodos.index', compact('periodos'));
    }

    public function create()
    {
        return view('periodos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'size:6',
                'regex:/^[0-9]{4}-[12]$/',
                'unique:periodo,nombre',
            ],
        ], [
            'nombre.required' => 'El nombre del período es obligatorio.',
            'nombre.size'     => 'El formato debe ser YYYY-S (6 caracteres, ej: 2025-1).',
            'nombre.regex'    => 'El formato debe ser YYYY-S (ej: 2025-1 o 2025-2).',
            'nombre.unique'   => 'Ya existe un período con ese nombre.',
        ]);

        Periodo::create(['nombre' => $request->nombre]);

        return redirect()->route('periodos.index')
            ->with('success', 'Período creado correctamente.');
    }

    public function edit(Periodo $periodo)
    {
        return view('periodos.edit', compact('periodo'));
    }

    public function update(Request $request, Periodo $periodo)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'size:6',
                'regex:/^[0-9]{4}-[12]$/',
                'unique:periodo,nombre,' . $periodo->id_periodo . ',id_periodo',
            ],
        ], [
            'nombre.required' => 'El nombre del período es obligatorio.',
            'nombre.size'     => 'El formato debe ser YYYY-S (6 caracteres, ej: 2025-1).',
            'nombre.regex'    => 'El formato debe ser YYYY-S (ej: 2025-1 o 2025-2).',
            'nombre.unique'   => 'Ya existe un período con ese nombre.',
        ]);

        $periodo->update(['nombre' => $request->nombre]);

        return redirect()->route('periodos.index')
            ->with('success', 'Período actualizado correctamente.');
    }

    public function destroy(Periodo $periodo)
    {
        $periodo->delete();

        return redirect()->route('periodos.index')
            ->with('success', 'Período eliminado correctamente.');
    }
}
