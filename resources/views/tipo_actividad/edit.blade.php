<x-layout title="Editar Tipo de Actividad">

    <div class="row justify-content-center">
        <div class="col-md-7">
            <x-card title="Editar Tipo de Actividad" color="warning">
                <form action="{{ route('tipo-actividad.update', $tipoActividad) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <x-form.input
                        name="nombre"
                        label="Nombre"
                        :value="$tipoActividad->nombre"
                        :maxlength="150"
                        autofocus
                    />

                    <x-form.lineas-check
                        :componentes="$componentes"
                        :seleccionadas="$lineasSeleccionadas"
                    />

                    <x-form.actions
                        :back="route('tipo-actividad.index')"
                        label="Actualizar"
                        color="warning"
                       
                    />
                </form>
            </x-card>
        </div>
    </div>

</x-layout>
