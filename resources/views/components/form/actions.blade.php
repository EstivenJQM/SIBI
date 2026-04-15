@props(['back', 'label' => 'Guardar', 'color' => 'sibi', 'icon' => 'bi-save'])

<div class="d-flex gap-2 mt-4">
    <button type="submit" class="btn btn-{{ $color }}">
        <i class="bi {{ $icon }} me-1"></i> {{ $label }}
    </button>
    <a href="{{ $back }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-1"></i> Cancelar
    </a>
</div>
