@props(['name', 'label', 'value' => '', 'placeholder' => '', 'maxlength' => 255, 'required' => true])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label fw-semibold">
        {{ $label }}
        @if($required) <span class="text-danger">*</span> @endif
    </label>
    <input
        type="text"
        id="{{ $name }}"
        name="{{ $name }}"
        maxlength="{{ $maxlength }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) }}
    >
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
