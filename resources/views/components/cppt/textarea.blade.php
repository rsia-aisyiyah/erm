<textarea class="form-control"
    id="{{ $id }}"
    name="{{ $name }}"
    cols="{{ $cols }}"
    rows="{{ $rows }}"
    onfocus="removeZero(this)"
    onblur="cekKosong(this)">{{ $value }}</textarea>
