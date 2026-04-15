<x-layout title="Editar Sede">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-card title="Editar Sede" color="warning">
                <form action="{{ route('sedes.update', $sede) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <x-form.input
                        name="codigo"
                        label="Código"
                        :value="$sede->codigo"
                        :maxlength="10"
                        autofocus
                    />

                    <x-form.input
                        name="nombre"
                        label="Nombre"
                        :value="$sede->nombre"
                        :maxlength="100"
                    />

                    <x-form.actions
                        :back="route('sedes.index')"
                        label="Actualizar"
                        color="warning"
                       
                    />
                </form>
            </x-card>
        </div>
    </div>

</x-layout>
