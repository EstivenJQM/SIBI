<x-layout title="Editar Componente">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-card title="<i class='bi bi-pencil-square me-2'></i>Editar Componente" color="warning">
                <form action="{{ route('componentes.update', $componente) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <x-form.select
                        name="id_area"
                        label="Área"
                        :options="$areas"
                        :selected="$componente->id_area"
                        placeholder="-- Seleccione un área --"
                    />

                    <x-form.input
                        name="nombre"
                        label="Nombre"
                        :value="$componente->nombre"
                        :maxlength="150"
                        autofocus
                    />

                    <x-form.actions
                        :back="route('componentes.index')"
                        label="Actualizar"
                        color="warning"
                        icon="bi-save"
                    />
                </form>
            </x-card>
        </div>
    </div>

</x-layout>
