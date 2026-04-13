<x-layout title="Tipos de Actividad">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">
            <i class="bi bi-tags-fill me-2 text-success"></i>Tipos de Actividad
        </h2>
        <a href="{{ route('tipo-actividad.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nuevo Tipo
        </a>
    </div>

    @forelse($tiposActividad as $tipo)
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">

                    <div class="flex-grow-1">
                        {{-- Nombre del tipo --}}
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-success fs-6 px-3">
                                <i class="bi bi-tag me-1"></i>{{ $tipo->nombre }}
                            </span>
                        </div>

                        {{-- Líneas asociadas agrupadas por Área › Componente --}}
                        @if($tipo->lineas->isNotEmpty())
                            @php
                                $porComponente = $tipo->lineas->groupBy('id_componente');
                            @endphp
                            @foreach($porComponente as $idComp => $lineas)
                                @php $comp = $lineas->first()->componente @endphp
                                <div class="ms-2 mb-1">
                                    <span class="small text-muted">
                                        <span class="badge bg-primary" style="font-size:.7rem">{{ $comp->area->nombre }}</span>
                                        <i class="bi bi-chevron-right mx-1" style="font-size:.65rem"></i>
                                        <span class="badge" style="background-color:#6f42c1;font-size:.7rem">{{ $comp->nombre }}</span>
                                    </span>
                                    <div class="ms-3 mt-1 d-flex flex-wrap gap-1">
                                        @foreach($lineas as $linea)
                                            <span class="badge rounded-pill px-2 py-1" style="background-color:#20c997;font-size:.75rem">
                                                <i class="bi bi-arrow-right-short"></i>{{ $linea->nombre }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted small ms-2 mb-0">Sin líneas asociadas.</p>
                        @endif
                    </div>

                    {{-- Acciones --}}
                    <div class="d-flex gap-1 ms-3 flex-shrink-0">
                        <a href="{{ route('tipo-actividad.edit', $tipo) }}"
                           class="btn btn-sm btn-warning" title="Editar">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('tipo-actividad.destroy', $tipo) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar el tipo «{{ $tipo->nombre }}»?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @empty
        <x-card>
            <p class="text-center text-muted mb-0 py-3">
                <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                No hay tipos de actividad registrados.
            </p>
        </x-card>
    @endforelse

</x-layout>
