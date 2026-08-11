@php
    $inputType = $type ? $type : 'text';
    $defaultValue = in_array($inputType, ['date', 'time', 'datetime-local', 'month', 'week', 'number', 'file', 'password', 'hidden']) ? '' : '-';
    $inputValue = $value ?? $defaultValue;
@endphp
<input
    {{ $attributes->merge(['class' => 'form-control form-control-sm']) }}
    @if ($attributes->has('style') && !empty($attributes->get('style'))) {{ $attributes->merge(['style' => $attributes->get('style')]) }} @endif
    id="{{ $id ?? $name}}"
    name="{{ $name ?? $id}}"
    placeholder="{{ $placeholder }}"
    onfocus="removeZero(this)"
    onblur="cekKosong(this)"
    value="{{ $inputValue }}"
    autocomplete="off"
    type="{{ $inputType }}"
    {{ $readonly ?? '' }} />
