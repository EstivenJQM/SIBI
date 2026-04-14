<x-layout title="Nueva Sede">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-card title="<i class='bi bi-plus-circle me-2'></i>Nueva Sede" color="primary">
                <form action="{{ route('sedes.store') }}" method="POST">
                    @csrf

                    <x-form.input
                        name="codigo"
                        label="Código"
                        placeholder="Ej: 10"
                        :maxlength="10"
                        autofocus
                    />

                    <x-form.input
                        name="nombre"
                        label="Nombre"
                        placeholder="Ej: SEDE CENTRAL MEDELLÍN"
                        :maxlength="100"
                    />

                    <x-form.actions :back="route('sedes.index')" label="Guardar" />
                </form>
            </x-card>
        </div>
    </div>

</x-layout>
