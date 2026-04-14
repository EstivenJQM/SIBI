<?php

namespace App\Http\Controllers;

use App\Models\Linea;
use App\Models\Periodo;
use App\Models\Sede;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::with([
            'linea.componente.area',
            'tipoActividad',
            'sede',
            'periodo',
        ])
            ->orderByDesc('fecha')
            ->get()
            ->groupBy('id_periodo');

        $periodos = Periodo::orderByDesc('nombre')->get()->keyBy('id_periodo');

        return view('servicios.index', compact('servicios', 'periodos'));
    }

    public function create()
    {
        $lineas   = Linea::with(['componente.area', 'tiposActividad'])
            ->orderBy('id_componente')
            ->orderBy('nombre')
            ->get();
        $sedes    = Sede::orderBy('nombre')->get();
        $periodos = Periodo::orderByDesc('nombre')->get();

        return view('servicios.create', compact('lineas', 'sedes', 'periodos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'           => 'required|string|max:200',
            'id_linea'         => 'required|exists:linea,id_linea',
            'id_tipo_actividad'=> 'required|exists:tipo_actividad,id_tipo_actividad',
            'id_sede'          => 'required|exists:sede,id_sede',
            'fecha'            => 'required|date',
            'id_periodo'       => 'required|exists:periodo,id_periodo',
        ], [
            'nombre.required'            => 'El nombre del servicio es obligatorio.',
            'nombre.max'                 => 'El nombre no puede superar los 200 caracteres.',
            'id_linea.required'          => 'Seleccione una línea.',
            'id_linea.exists'            => 'La línea seleccionada no existe.',
            'id_tipo_actividad.required' => 'Seleccione un tipo de actividad.',
            'id_tipo_actividad.exists'   => 'El tipo de actividad seleccionado no existe.',
            'id_sede.required'           => 'Seleccione una sede.',
            'id_sede.exists'             => 'La sede seleccionada no existe.',
            'fecha.required'             => 'La fecha es obligatoria.',
            'fecha.date'                 => 'La fecha no tiene un formato válido.',
            'id_periodo.required'        => 'Seleccione un período.',
            'id_periodo.exists'          => 'El período seleccionado no existe.',
        ]);

        // Verificar que la combinación línea + tipo actividad existe en linea_tipo_actividad
        $combinacionValida = \DB::table('linea_tipo_actividad')
            ->where('id_linea', $request->id_linea)
            ->where('id_tipo_actividad', $request->id_tipo_actividad)
            ->exists();

        if (! $combinacionValida) {
            return back()->withInput()
                ->withErrors(['id_tipo_actividad' => 'El tipo de actividad no está asociado a la línea seleccionada.']);
        }

        Servicio::create([
            'nombre'            => $request->nombre,
            'id_linea'          => $request->id_linea,
            'id_tipo_actividad' => $request->id_tipo_actividad,
            'id_sede'           => $request->id_sede,
            'fecha'             => $request->fecha,
            'id_periodo'        => $request->id_periodo,
        ]);

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio creado correctamente.');
    }

    public function edit(Servicio $servicio)
    {
        $lineas   = Linea::with(['componente.area', 'tiposActividad'])
            ->orderBy('id_componente')
            ->orderBy('nombre')
            ->get();
        $sedes    = Sede::orderBy('nombre')->get();
        $periodos = Periodo::orderByDesc('nombre')->get();

        return view('servicios.edit', compact('servicio', 'lineas', 'sedes', 'periodos'));
    }

    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([
            'nombre'           => 'required|string|max:200',
            'id_linea'         => 'required|exists:linea,id_linea',
            'id_tipo_actividad'=> 'required|exists:tipo_actividad,id_tipo_actividad',
            'id_sede'          => 'required|exists:sede,id_sede',
            'fecha'            => 'required|date',
            'id_periodo'       => 'required|exists:periodo,id_periodo',
        ], [
            'nombre.required'            => 'El nombre del servicio es obligatorio.',
            'nombre.max'                 => 'El nombre no puede superar los 200 caracteres.',
            'id_linea.required'          => 'Seleccione una línea.',
            'id_linea.exists'            => 'La línea seleccionada no existe.',
            'id_tipo_actividad.required' => 'Seleccione un tipo de actividad.',
            'id_tipo_actividad.exists'   => 'El tipo de actividad seleccionado no existe.',
            'id_sede.required'           => 'Seleccione una sede.',
            'id_sede.exists'             => 'La sede seleccionada no existe.',
            'fecha.required'             => 'La fecha es obligatoria.',
            'fecha.date'                 => 'La fecha no tiene un formato válido.',
            'id_periodo.required'        => 'Seleccione un período.',
            'id_periodo.exists'          => 'El período seleccionado no existe.',
        ]);

        $combinacionValida = \DB::table('linea_tipo_actividad')
            ->where('id_linea', $request->id_linea)
            ->where('id_tipo_actividad', $request->id_tipo_actividad)
            ->exists();

        if (! $combinacionValida) {
            return back()->withInput()
                ->withErrors(['id_tipo_actividad' => 'El tipo de actividad no está asociado a la línea seleccionada.']);
        }

        $servicio->update([
            'nombre'            => $request->nombre,
            'id_linea'          => $request->id_linea,
            'id_tipo_actividad' => $request->id_tipo_actividad,
            'id_sede'           => $request->id_sede,
            'fecha'             => $request->fecha,
            'id_periodo'        => $request->id_periodo,
        ]);

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio eliminado correctamente.');
    }
}
