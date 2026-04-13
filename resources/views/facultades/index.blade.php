<x-layout title="Facultades">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">
            <i class="bi bi-building me-2" style="color:#196844"></i>Facultades
        </h2>
        <a href="{{ route('facultades.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nueva Facultad
        </a>
    </div>

    @forelse($facultades as $facultad)
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">

                    <div class="flex-grow-1">
                        <div class="fw-bold fs-6 mb-2">
                            <i class="bi bi-building me-1 text-muted"></i>{{ $facultad->nombre }}
                        </div>

                        @if($facultad->sedes->isNotEmpty())
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($facultad->sedes as $sede)
                                    <span class="badge d-flex align-items-center gap-1 px-2 py-1"
                                          style="background-color:#196844; font-size:.78rem">
                                        <span class="badge bg-white text-dark" style="font-size:.68rem">
                                            {{ $sede->codigo }}
                                        </span>
                                        {{ $sede->nombre }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted small mb-0">Sin sedes asociadas.</p>
                        @endif
                    </div>

                    <div class="d-flex gap-1 ms-3 flex-shrink-0">
                        <a href="{{ route('facultades.edit', $facultad) }}"
                           class="btn btn-sm btn-warning" title="Editar">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('facultades.destroy', $facultad) }}" method="POST"
                              class="d-inline"
                              onsubmit="return confirm('¿Eliminar la facultad «{{ $facultad->nombre }}»?')">
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
                No hay facultades registradas.
            </p>
        </x-card>
    @endforelse

</x-layout>
