<x-layout title="Editar Línea">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <x-card title="<i class='bi bi-pencil-square me-2'></i>Editar Línea" color="warning">
                <form action="{{ route('lineas.update', $linea) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="id_componente" class="form-label fw-semibold">
                            Componente <span class="text-danger">*</span>
                        </label>
                        <select id="id_componente" name="id_componente" required
                                class="form-select {{ $errors->has('id_componente') ? 'is-invalid' : '' }}">
                            <option value="">-- Seleccione un componente --</option>
                            @foreach($componentes as $componente)
                                <option value="{{ $componente->id_componente }}"
                                    {{ old('id_componente', $linea->id_componente) == $componente->id_componente ? 'selected' : '' }}>
                                    {{ $componente->area->nombre }} › {{ $componente->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_componente')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-form.input
                        name="nombre"
                        label="Nombre"
                        :value="$linea->nombre"
                        :maxlength="150"
                        autofocus
                    />

                    <x-form.actions
                        :back="route('lineas.index')"
                        label="Actualizar"
                        color="warning"
                        icon="bi-save"
                    />
                </form>
            </x-card>
        </div>
    </div>

</x-layout>
