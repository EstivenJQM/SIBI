@props([
    'name',
    'label',
    'items',
    'seleccionados' => [],
    'keyField'      => 'id',
    'labelField'    => 'nombre',
    'subLabel'      => null,   // campo secundario a mostrar antes del label (ej. codigo)
])

<div class="mb-3">
    <label class="form-label fw-semibold">
        {{ $label }} <span class="text-danger">*</span>
    </label>

    @if($items->isEmpty())
        <p class="text-muted small">No hay opciones disponibles.</p>
    @else
        <div class="border rounded p-3" style="max-height: 280px; overflow-y: auto;">
            @foreach($items as $item)
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="{{ $name }}[]"
                        value="{{ $item->$keyField }}"
                        id="{{ $name }}_{{ $item->$keyField }}"
                        {{ in_array($item->$keyField, old($name, $seleccionados)) ? 'checked' : '' }}
                    >
                    <label class="form-check-label small" for="{{ $name }}_{{ $item->$keyField }}">
                        @if($subLabel)
                            <span class="badge bg-secondary me-1" style="font-size:.7rem">
                                {{ $item->$subLabel }}
                            </span>
                        @endif
                        {{ $item->$labelField }}
                    </label>
                </div>
            @endforeach
        </div>

        @error($name)
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
        @error($name . '.*')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    @endif
</div>
