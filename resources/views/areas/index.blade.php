<x-layout title="Áreas">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><i class="bi bi-diagram-3-fill me-2 text-primary"></i>Áreas</h2>
        <a href="{{ route('areas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nueva Área
        </a>
    </div>

    @forelse($areas as $area)
        <x-areas.tree-item :area="$area" />
    @empty
        <x-card>
            <p class="text-center text-muted mb-0 py-3">
                <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                No hay áreas registradas.
            </p>
        </x-card>
    @endforelse

</x-layout>
