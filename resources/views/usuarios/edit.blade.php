<x-layout title="Editar Usuario">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <x-card title="Editar Usuario" color="warning">
                <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Datos personales --}}
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <x-form.input
                                name="primer_nombre"
                                label="Primer nombre"
                                :value="$usuario->primer_nombre"
                                :maxlength="50"
                                autofocus
                            />
                        </div>
                        <div class="col-sm-6">
                            <x-form.input
                                name="segundo_nombre"
                                label="Segundo nombre"
                                :value="$usuario->segundo_nombre"
                                :maxlength="50"
                                :required="false"
                            />
                        </div>
                        <div class="col-sm-6">
                            <x-form.input
                                name="primer_apellido"
                                label="Primer apellido"
                                :value="$usuario->primer_apellido"
                                :maxlength="50"
                            />
                        </div>
                        <div class="col-sm-6">
                            <x-form.input
                                name="segundo_apellido"
                                label="Segundo apellido"
                                :value="$usuario->segundo_apellido"
                                :maxlength="50"
                                :required="false"
                            />
                        </div>
                        <div class="col-sm-6">
                            <x-form.input
                                name="documento"
                                label="Documento"
                                :value="$usuario->documento"
                                :maxlength="20"
                            />
                        </div>
                        <div class="col-sm-6">
                            <x-form.input
                                name="correo"
                                label="Correo"
                                :value="$usuario->correo"
                                :maxlength="100"
                                :required="false"
                            />
                        </div>
                    </div>

                    <x-form.actions
                        :back="route('usuarios.index')"
                        label="Actualizar"
                        color="warning"
                        icon="bi-save"
                    />
                </form>
            </x-card>

            {{-- Roles en sedes --}}
            @if($usuario->rolesEnSedes->isNotEmpty())
                <div class="mt-3">
                    <x-card title="Roles asignados">
                        <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Campos ocultos de datos personales para que la validación no falle --}}
                            <input type="hidden" name="documento"        value="{{ $usuario->documento }}">
                            <input type="hidden" name="primer_nombre"    value="{{ $usuario->primer_nombre }}">
                            <input type="hidden" name="segundo_nombre"   value="{{ $usuario->segundo_nombre }}">
                            <input type="hidden" name="primer_apellido"  value="{{ $usuario->primer_apellido }}">
                            <input type="hidden" name="segundo_apellido" value="{{ $usuario->segundo_apellido }}">
                            <input type="hidden" name="correo"           value="{{ $usuario->correo }}">

                            <div class="border rounded-3" style="overflow:hidden;">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Rol</th>
                                                <th>Sede</th>
                                                <th>Período</th>
                                                <th style="width:130px">Estado</th>
                                                <th style="width:50px"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($usuario->rolesEnSedes as $urs)
                                                <tr>
                                                    <td class="align-middle">
                                                        <span class="badge bg-secondary">{{ $urs->rol?->nombre ?? '—' }}</span>
                                                    </td>
                                                    <td class="align-middle small">
                                                        @if($urs->sede)
                                                            <span class="badge bg-secondary me-1" style="font-size:.65rem">{{ $urs->sede->codigo }}</span>
                                                            {{ $urs->sede->nombre }}
                                                        @else
                                                            —
                                                        @endif
                                                    </td>
                                                    <td class="align-middle small">
                                                        {{ $urs->periodo?->nombre ?? '—' }}
                                                    </td>
                                                    <td class="align-middle">
                                                        <select name="roles[{{ $urs->id_usuario_rol_sede }}][estado]"
                                                                class="form-select form-select-sm">
                                                            <option value="activo"   {{ $urs->estado === 'activo'   ? 'selected' : '' }}>Activo</option>
                                                            <option value="inactivo" {{ $urs->estado === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                                        </select>
                                                        {{-- campos ocultos requeridos por validación --}}
                                                        <input type="hidden" name="roles[{{ $urs->id_usuario_rol_sede }}][id_rol]"     value="{{ $urs->id_rol }}">
                                                        <input type="hidden" name="roles[{{ $urs->id_usuario_rol_sede }}][id_sede]"    value="{{ $urs->id_sede }}">
                                                        <input type="hidden" name="roles[{{ $urs->id_usuario_rol_sede }}][id_periodo]" value="{{ $urs->id_periodo }}">
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                title="Eliminar rol"
                                                                onclick="eliminarRol('{{ route('usuarios.roles.destroy', [$usuario, $urs]) }}')">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <i class="bi bi-save me-1"></i> Guardar estados
                                </button>
                            </div>
                        </form>
                    </x-card>
                </div>
            @endif

        </div>
    </div>

    {{-- Form reutilizable para eliminar roles (evita forms anidados) --}}
    <form id="form-eliminar-rol" method="POST" style="display:none">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function eliminarRol(url) {
            if (!confirm('¿Eliminar este rol del usuario?')) return;
            const form = document.getElementById('form-eliminar-rol');
            form.action = url;
            form.submit();
        }
    </script>

</x-layout>
