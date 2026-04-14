<x-layout title="Nuevo Componente">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-card title="<i class='bi bi-plus-circle me-2'></i>Nuevo Componente" color="primary">
                <form action="{{ route('componentes.store') }}" method="POST">
                    @csrf

                    <x-form.select
                        name="id_area"
                        label="Área"
                        :options="$areas"
                        placeholder="-- Seleccione un área --"
                    />

                    <x-form.input
                        name="nombre"
                        label="Nombre"
                        placeholder="Ej: Psicosocial"
                        :maxlength="150"
                        autofocus
                    />

                    <x-form.actions :back="route('componentes.index')" label="Guardar" />
                </form>
            </x-card>
        </div>
    </div>

</x-layout>
