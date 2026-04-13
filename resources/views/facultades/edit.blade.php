<x-layout title="Editar Facultad">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-card title="<i class='bi bi-pencil-square me-2'></i>Editar Facultad" color="warning">
                <form action="{{ route('facultades.update', $facultad) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <x-form.input
                        name="nombre"
                        label="Nombre"
                        :value="$facultad->nombre"
                        :maxlength="150"
                        autofocus
                    />

                    <x-form.checkboxes
                        name="sedes"
                        label="Sedes"
                        :items="$sedes"
                        keyField="id_sede"
                        subLabel="codigo"
                        :seleccionados="$sedesSeleccionadas"
                    />

                    <x-form.actions
                        :back="route('facultades.index')"
                        label="Actualizar"
                        color="warning"
                        icon="bi-save"
                    />
                </form>
            </x-card>
        </div>
    </div>

</x-layout>
