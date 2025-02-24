<input
    type="checkbox"
    class="form-check-input br-full"
    id="{{ $id }}"
    name="{{ $name }}"
    value="{{ $value }}"
    @if (isset($onchange)) onchange="{{ $onchange }}" @endif
    @if ($checked) checked @endif />
<label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
