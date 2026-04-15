@props(['sedes', 'sedesPrograma' => [], 'planesEstudioBySede' => []])

{{--
    sedesPrograma:       colección keyBy('id_sede') con pivot->codigo_snies
    planesEstudioBySede: colección/array keyBy('id_sede') con string de planes (ej: "2019, 2022")
    Envía:
      sedes[]                       → IDs seleccionados
      codigo_snies[{id}]            → código SNIES por sede
      planes_estudio[{id}]          → planes de estudio separados por coma
--}}

<div class="mb-3">
    <label class="form-label fw-semibold">
        Sedes <span class="text-danger">*</span>
        <span class="text-muted fw-normal small ms-1">— indique el código SNIES y los planes de estudio si aplica</span>
    </label>

    @error('sedes')
        <div class="text-danger small mb-1">{{ $message }}</div>
    @enderror

    <div class="border rounded-3" style="overflow:hidden;">
        <div style="max-height:340px; overflow:auto;">
        <table class="table table-sm table-hover mb-0" style="min-width:600px">
            <thead class="table-light">
                <tr>
                    <th style="width:40px"></th>
                    <th style="width:80px">Código</th>
                    <th>Sede</th>
                    <th style="width:150px">Código SNIES</th>
                    <th style="width:200px">
                        Planes de estudio
                        <span class="text-muted fw-normal" style="font-size:.7rem">(separados por coma)</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($sedes as $sede)
                    @php
                        $checked     = isset($sedesPrograma[$sede->id_sede]);
                        $codigoSnies = $checked ? $sedesPrograma[$sede->id_sede]->pivot->codigo_snies : null;
                        $oldChecked  = in_array($sede->id_sede, old('sedes', []));
                        $isChecked   = old('sedes') !== null ? $oldChecked : $checked;
                        $sniesVal    = old("codigo_snies.{$sede->id_sede}", $codigoSnies);
                        $planesVal   = old("planes_estudio.{$sede->id_sede}", $planesEstudioBySede[$sede->id_sede] ?? '');
                    @endphp
                    <tr>
                        <td class="text-center align-middle">
                            <input
                                class="form-check-input sede-check"
                                type="checkbox"
                                name="sedes[]"
                                value="{{ $sede->id_sede }}"
                                id="sede_{{ $sede->id_sede }}"
                                data-target-snies="snies_{{ $sede->id_sede }}"
                                data-target-planes="planes_{{ $sede->id_sede }}"
                                {{ $isChecked ? 'checked' : '' }}
                            >
                        </td>
                        <td class="align-middle">
                            <label for="sede_{{ $sede->id_sede }}" class="mb-0">
                                <span class="badge bg-secondary">{{ $sede->codigo }}</span>
                            </label>
                        </td>
                        <td class="align-middle">
                            <label for="sede_{{ $sede->id_sede }}" class="mb-0 fw-semibold small">
                                {{ $sede->nombre }}
                            </label>
                        </td>
                        <td class="align-middle">
                            <input
                                type="text"
                                id="snies_{{ $sede->id_sede }}"
                                name="codigo_snies[{{ $sede->id_sede }}]"
                                maxlength="20"
                                placeholder="Opcional"
                                value="{{ $sniesVal }}"
                                class="form-control form-control-sm"
                                {{ $isChecked ? '' : 'disabled' }}
                            >
                        </td>
                        <td class="align-middle">
                            <input
                                type="text"
                                id="planes_{{ $sede->id_sede }}"
                                name="planes_estudio[{{ $sede->id_sede }}]"
                                maxlength="200"
                                placeholder="Ej: 2019, 2022"
                                value="{{ $planesVal }}"
                                class="form-control form-control-sm"
                                {{ $isChecked ? '' : 'disabled' }}
                            >
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

<script>
document.querySelectorAll('.sede-check').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        var sniesInput  = document.getElementById(this.dataset.targetSnies);
        var planesInput = document.getElementById(this.dataset.targetPlanes);

        sniesInput.disabled = !this.checked;
        if (!this.checked) sniesInput.value = '';

        if (planesInput) {
            planesInput.disabled = !this.checked;
            if (!this.checked) planesInput.value = '';
        }
    });
});
</script>
