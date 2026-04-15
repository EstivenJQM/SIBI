<x-layout title="Editar Área">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-card title="Editar Área" color="warning">
                <form action="{{ route('areas.update', $area) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <x-form.input
                        name="nombre"
                        label="Nombre"
                        :value="$area->nombre"
                        :maxlength="150"
                        autofocus
                    />

                    <x-form.actions
                        :back="route('areas.index')"
                        label="Actualizar"
                        color="warning"
                       
                    />
                </form>
            </x-card>
        </div>
    </div>

</x-layout>
