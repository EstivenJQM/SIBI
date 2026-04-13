@props(['name', 'label', 'options', 'selected' => null, 'placeholder' => '-- Seleccione --', 'required' => true])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label fw-semibold">
        {{ $label }}
        @if($required) <span class="text-danger">*</span> @endif
    </label>
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : '')]) }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $option)
            <option value="{{ $option->getKey() }}"
                {{ old($name, $selected) == $option->getKey() ? 'selected' : '' }}>
                {{ $option->nombre }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
