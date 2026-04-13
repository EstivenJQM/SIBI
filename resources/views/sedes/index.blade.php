<x-layout title="Sedes">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">
            <i class="bi bi-geo-alt-fill me-2" style="color:#196844"></i>Sedes
        </h2>
        <a href="{{ route('sedes.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nueva Sede
        </a>
    </div>

    <x-card :padding="false">
        <table class="table table-hover table-striped mb-0">
            <thead style="background-color:#196844; color:#fff">
                <tr>
                    <th style="width:120px">Código</th>
                    <th>Nombre</th>
                    <th class="text-center" style="width:120px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sedes as $sede)
                    <tr>
                        <td>
                            <span class="badge bg-secondary">{{ $sede->codigo }}</span>
                        </td>
                        <td class="fw-semibold">{{ $sede->nombre }}</td>
                        <td class="text-center">
                            <a href="{{ route('sedes.edit', $sede) }}"
                               class="btn btn-sm btn-warning" title="Editar">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('sedes.destroy', $sede) }}" method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('¿Eliminar la sede «{{ $sede->nombre }}»?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                            No hay sedes registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-card>

</x-layout>
