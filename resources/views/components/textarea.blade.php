<textarea
    {{ $attributes->merge(['class' => 'form-control']) }}
    name="{{ $name }}"
    id="{{ $id }}"
    cols="{{ $cols }}"
    rows="{{ $rows }}"
    onfocus="removeZero(this)"
    onblur="cekKosong(this)">{{ $slot ?? '-' }}</textarea>
