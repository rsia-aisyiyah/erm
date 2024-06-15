<input {{ $attributes->merge(['style' => $style]) }} type="text"
    class="form-control form-control-sm {{ $align }} {{ $border }}"
    onfocus="removeZero(this)"
    onblur="cekKosong(this)"
    name={{ $id }}
    name={{ $name }}
    value="-" />
