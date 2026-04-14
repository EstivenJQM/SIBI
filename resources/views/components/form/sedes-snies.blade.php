@props(['sedes', 'sedesPrograma' => []])

{{--
    sedesPrograma: colección keyBy('id_sede') con pivot->codigo_snies
    Envía:
      sedes[]              → IDs seleccionados
      codigo_snies[{id}]   → código SNIES por sede
--}}

<div class="mb-3">
    <label class="form-label fw-semibold">
        Sedes <span class="text-danger">*</span>
        <span class="text-muted fw-normal small ms-1">— indique el código SNIES si aplica</span>
    </label>

    @error('sedes')
        <div class="text-danger small mb-1">{{ $message }}</div>
    @enderror

    <div class="border rounded" style="max-height:320px; overflow-y:auto;">
        <table class="table table-sm table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width:40px"></th>
                    <th style="width:80px">Código</th>
                    <th>Sede</th>
                    <th style="width:160px">Código SNIES</th>
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
                    @endphp
                    <tr>
                        <td class="text-center align-middle">
                            <input
                                class="form-check-input sede-check"
                                type="checkbox"
                                name="sedes[]"
                                value="{{ $sede->id_sede }}"
                                id="sede_{{ $sede->id_sede }}"
                                data-target="snies_{{ $sede->id_sede }}"
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.querySelectorAll('.sede-check').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        var input = document.getElementById(this.dataset.target);
        input.disabled = !this.checked;
        if (!this.checked) input.value = '';
    });
});
</script>
