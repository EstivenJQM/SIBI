<x-layout title="Programas">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">
            <i class="bi bi-journal-bookmark-fill me-2" style="color:#196844"></i>Programas
        </h2>
        <a href="{{ route('programas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nuevo Programa
        </a>
    </div>

    @if($programas->isEmpty())
        <x-card>
            <p class="text-center text-muted mb-0 py-3">
                <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                No hay programas registrados.
            </p>
        </x-card>
    @else
        @foreach($facultades as $idFacultad => $facultad)
            @if($programas->has($idFacultad))
                {{-- Cabecera facultad --}}
                <div class="d-flex align-items-center gap-2 mt-3 mb-2">
                    <span class="badge px-3 py-2 fs-6" style="background-color:#196844">
                        <i class="bi bi-building me-1"></i>{{ $facultad->nombre }}
                    </span>
                </div>

                @foreach($programas[$idFacultad] as $programa)
                    <div class="card shadow-sm mb-2">
                        <div class="card-body py-2">
                            <div class="d-flex justify-content-between align-items-start">

                                <div class="flex-grow-1">
                                    {{-- Nombre + tipo formación --}}
                                    <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                        <span class="fw-semibold">{{ $programa->nombre }}</span>
                                        @if($programa->tipoFormacion)
                                            <span class="badge bg-secondary" style="font-size:.72rem">
                                                {{ $programa->tipoFormacion->nivel->nombre }}
                                            </span>
                                            <span class="badge bg-light text-dark border" style="font-size:.72rem">
                                                {{ $programa->tipoFormacion->nombre }}
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Sedes con SNIES --}}
                                    @if($programa->sedes->isNotEmpty())
                                        <div class="d-flex flex-wrap gap-2 mt-1">
                                            @foreach($programa->sedes as $sede)
                                                <span class="badge d-flex align-items-center gap-1 px-2 py-1"
                                                      style="background-color:#196844;font-size:.75rem">
                                                    <span class="badge bg-white text-dark" style="font-size:.65rem">
                                                        {{ $sede->codigo }}
                                                    </span>
                                                    {{ $sede->nombre }}
                                                    @if($sede->pivot->codigo_snies)
                                                        <span class="badge bg-warning text-dark ms-1" style="font-size:.65rem">
                                                            SNIES {{ $sede->pivot->codigo_snies }}
                                                        </span>
                                                    @endif
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="d-flex gap-1 ms-3 flex-shrink-0">
                                    <a href="{{ route('programas.edit', $programa) }}"
                                       class="btn btn-sm btn-warning" title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('programas.destroy', $programa) }}" method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('¿Eliminar el programa «{{ $programa->nombre }}»?')">
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
                @endforeach
            @endif
        @endforeach
    @endif

</x-layout>
