@props([
    'label' => '',
    'wrap' => '',
])

<div class="{{ $wrap }}">
    <label class="fw-bold">{{ $label }}</label>
    <input {{ $attributes }}>
</div>