<x-layout title="Componentes">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><i class="bi bi-collection-fill me-2 text-purple" style="color:#6f42c1"></i>Componentes</h2>
        <a href="{{ route('componentes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nuevo Componente
        </a>
    </div>

    @if($componentes->isEmpty())
        <x-card>
            <p class="text-center text-muted mb-0 py-3">
                <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                No hay componentes registrados.
            </p>
        </x-card>
    @else
        @foreach($areas as $idArea => $area)
            @if($componentes->has($idArea))
                {{-- Cabecera del Área --}}
                <div class="d-flex align-items-center gap-2 mb-2 mt-3">
                    <span class="badge bg-primary fs-6 px-3 py-2">
                        <i class="bi bi-diagram-3 me-1"></i>{{ $area->nombre }}
                    </span>
                </div>

                @foreach($componentes[$idArea] as $componente)
                    {{-- Fila Componente --}}
                    <div class="tree-comp rounded p-3 mb-2 bg-white shadow-sm">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span class="badge rounded-pill px-2" style="background-color:#6f42c1">Componente</span>
                                    <span class="fw-semibold">{{ $componente->nombre }}</span>
                                </div>

                                {{-- Líneas anidadas --}}
                                @if($componente->lineas->isNotEmpty())
                                    <div class="ms-3">
                                        @foreach($componente->lineas as $linea)
                                            <div class="tree-linea rounded px-2 py-1 mb-1 bg-light d-inline-flex align-items-center gap-2 me-2">
                                                <span class="badge rounded-pill px-2" style="background-color:#20c997">Línea</span>
                                                <span class="small">{{ $linea->nombre }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted small ms-3 mb-0">Sin líneas registradas.</p>
                                @endif
                            </div>

                            <div class="d-flex gap-1 ms-3 flex-shrink-0">
                                <a href="{{ route('componentes.edit', $componente) }}"
                                   class="btn btn-sm btn-warning" title="Editar">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('componentes.destroy', $componente) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar el componente «{{ $componente->nombre }}»?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    @endif

</x-layout>
