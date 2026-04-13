@props(['area'])

<div class="tree-area rounded p-3 mb-3 bg-white shadow-sm">

    {{-- Área --}}
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-primary rounded-pill px-2">Área</span>
            <span class="fw-bold fs-6">{{ $area->nombre }}</span>
        </div>
        <div class="d-flex gap-1">
            <a href="{{ route('areas.edit', $area) }}"
               class="btn btn-sm btn-warning" title="Editar área">
                <i class="bi bi-pencil-fill"></i>
            </a>
            <form action="{{ route('areas.destroy', $area) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('¿Eliminar el área «{{ $area->nombre }}»?\nSe eliminarán también sus componentes y líneas.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar área">
                    <i class="bi bi-trash-fill"></i>
                </button>
            </form>
        </div>
    </div>

    {{-- Componentes --}}
    @if($area->componentes->isNotEmpty())
        <div class="mt-2 ms-3">
            @foreach($area->componentes as $componente)
                <div class="tree-comp rounded p-2 mb-2 bg-light">

                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-purple text-white rounded-pill px-2"
                              style="background-color:#6f42c1!important">Componente</span>
                        <span class="fw-semibold">{{ $componente->nombre }}</span>
                    </div>

                    {{-- Líneas --}}
                    @if($componente->lineas->isNotEmpty())
                        <div class="mt-2 ms-3">
                            @foreach($componente->lineas as $linea)
                                <div class="tree-linea rounded px-2 py-1 mb-1 bg-white d-flex align-items-center gap-2">
                                    <span class="badge rounded-pill px-2"
                                          style="background-color:#20c997">Línea</span>
                                    <span class="small">{{ $linea->nombre }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted small ms-3 mb-0 mt-1">Sin líneas registradas.</p>
                    @endif

                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted small ms-3 mb-0 mt-2">Sin componentes registrados.</p>
    @endif

</div>
