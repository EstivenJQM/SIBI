<x-layout title="Editar Programa">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-card title="<i class='bi bi-pencil-square me-2'></i>Editar Programa" color="warning">
                <form action="{{ route('programas.update', $programa) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <x-form.input
                        name="nombre"
                        label="Nombre del programa"
                        :value="$programa->nombre"
                        :maxlength="150"
                        autofocus
                    />

                    <x-form.select
                        name="id_facultad"
                        label="Facultad"
                        :options="$facultades"
                        keyField="id_facultad"
                        :selected="$programa->id_facultad"
                        placeholder="-- Seleccione una facultad --"
                    />

                    {{-- Tipo de formación agrupado por nivel --}}
                    <div class="mb-3">
                        <label for="id_tipo_formacion" class="form-label fw-semibold">
                            Tipo de formación
                            <span class="text-muted fw-normal small">(opcional)</span>
                        </label>
                        <select id="id_tipo_formacion" name="id_tipo_formacion"
                                class="form-select {{ $errors->has('id_tipo_formacion') ? 'is-invalid' : '' }}">
                            <option value="">-- Sin especificar --</option>
                            @foreach($niveles as $nivel)
                                <optgroup label="{{ $nivel->nombre }}">
                                    @foreach($nivel->tiposFormacion as $tipo)
                                        <option value="{{ $tipo->id_tipo_formacion }}"
                                            {{ old('id_tipo_formacion', $programa->id_tipo_formacion) == $tipo->id_tipo_formacion ? 'selected' : '' }}>
                                            {{ $tipo->nombre }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('id_tipo_formacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <x-form.sedes-snies :sedes="$sedes" :sedesPrograma="$sedesPrograma" />

                    <x-form.actions
                        :back="route('programas.index')"
                        label="Actualizar"
                        color="warning"
                        icon="bi-save"
                    />
                </form>
            </x-card>
        </div>
    </div>

</x-layout>
