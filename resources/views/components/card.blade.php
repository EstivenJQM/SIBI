@props(['title' => null, 'color' => 'primary', 'padding' => true])

<div class="card shadow-sm">
    @if($title)
        <div class="card-header bg-{{ $color }} {{ in_array($color, ['warning','light']) ? '' : 'text-white' }}">
            <h5 class="mb-0">{{ $title }}</h5>
        </div>
    @endif
    <div class="{{ $padding ? 'card-body' : 'card-body p-0' }}">
        {{ $slot }}
    </div>
</div>
