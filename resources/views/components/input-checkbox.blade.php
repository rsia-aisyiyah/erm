<input
    type="checkbox"
    class="form-check-input"
    id="{{ $id }}"
    name="{{ $name }}"
    value="{{ $value }}"
    @if ($checked) checked @endif />
<label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
