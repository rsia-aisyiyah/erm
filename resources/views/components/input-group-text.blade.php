<div {{ $attributes->merge(['class' => 'input-group-text']) }}
    style="{{ $style }}">
    <label for="{{ $for }}">{{ $label == null ? $slot : $label }}</label>
</div>
