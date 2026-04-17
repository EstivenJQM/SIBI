<x-layout title="Períodos">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            <i class="bi bi-calendar3 me-2" style="color:#196844"></i>Períodos
        </h2>
        <a href="{{ route('periodos.create') }}" class="btn btn-sibi">
            <i class="bi bi-plus-lg me-1"></i> Nuevo Período
        </a>
    </div>

    @if($periodos->isEmpty())
        <x-card>
            <p class="text-center text-muted mb-0 py-4">
                <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
                No hay períodos registrados.
            </p>
        </x-card>
    @else
        <div class="row g-3">
            @foreach($periodos as $periodo)
                @php
                    [$anio, $semestre] = explode('-', $periodo->nombre);
                    $esPrimero = $semestre === '1';
                @endphp

                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card h-100 shadow-sm" style="border-top: 4px solid #196844">

                        <div class="card-body pb-2">

                            {{-- Nombre del período --}}
                            <div class="fw-bold mb-1" style="font-size:1.6rem;line-height:1;color:#196844">
                                {{ $periodo->nombre }}
                            </div>

                            {{-- Semestre --}}
                            <span class="badge mb-3"
                                  style="background-color:{{ $esPrimero ? '#196844' : '#ffd400' }};color:{{ $esPrimero ? '#fff' : '#000' }};font-size:.8rem">
                                <i class="bi bi-{{ $esPrimero ? 'sunrise' : 'sunset' }} me-1"></i>
                                {{ $esPrimero ? 'Primer semestre' : 'Segundo semestre' }}
                            </span>

                            {{-- Estadísticas --}}
                            <div class="d-flex gap-2">
                                <div class="flex-fill text-center p-2 rounded" style="background:#f3f4f6">
                                    <div class="fw-bold" style="color:#196844;font-size:1.25rem">
                                        {{ number_format($periodo->servicios_count) }}
                                    </div>
                                    <div class="text-muted" style="font-size:.72rem">
                                        <i class="bi bi-tools me-1"></i>Servicios
                                    </div>
                                </div>
                                <div class="flex-fill text-center p-2 rounded" style="background:#f3f4f6">
                                    <div class="fw-bold" style="color:#196844;font-size:1.25rem">
                                        {{ number_format($periodo->usuarios_servicios_count) }}
                                    </div>
                                    <div class="text-muted" style="font-size:.72rem">
                                        <i class="bi bi-people me-1"></i>En servicios
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer bg-white border-top d-flex justify-content-end gap-1 py-2">
                            <a href="{{ route('periodos.edit', $periodo) }}"
                               class="btn btn-sm btn-outline-secondary" title="Editar">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('periodos.destroy', $periodo) }}" method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('¿Eliminar el período «{{ $periodo->nombre }}»?')">
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
        </div>
    @endif

</x-layout>
