<x-layout title="Líneas">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">
            <i class="bi bi-list-ul me-2" style="color:#20c997"></i>Líneas
        </h2>
        <a href="{{ route('lineas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nueva Línea
        </a>
    </div>

    @if($componentes->isEmpty())
        <x-card>
            <p class="text-center text-muted mb-0 py-3">
                <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                No hay líneas registradas.
            </p>
        </x-card>
    @else
        @foreach($componentes as $idComp => $componente)
            @if($lineas->has($idComp))
                {{-- Cabecera Área --}}
                <div class="d-flex align-items-center gap-2 mt-3 mb-1">
                    <span class="badge bg-primary px-3 py-2 fs-6">
                        <i class="bi bi-diagram-3 me-1"></i>{{ $componente->area->nombre }}
                    </span>
                    <i class="bi bi-chevron-right text-muted"></i>
                    <span class="badge px-3 py-2 fs-6" style="background-color:#6f42c1">
                        <i class="bi bi-collection me-1"></i>{{ $componente->nombre }}
                    </span>
                </div>

                @foreach($lineas[$idComp] as $linea)
                    <div class="tree-linea rounded p-3 mb-2 bg-white shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge rounded-pill px-2" style="background-color:#20c997">Línea</span>
                                <span class="fw-semibold">{{ $linea->nombre }}</span>
                            </div>
                            <div class="d-flex gap-1">
                                <a href="{{ route('lineas.edit', $linea) }}"
                                   class="btn btn-sm btn-warning" title="Editar">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <form action="{{ route('lineas.destroy', $linea) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar la línea «{{ $linea->nombre }}»?')">
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
