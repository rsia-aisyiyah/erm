<select {{ $attributes->merge(['class' => 'form-select form-select-sm']) }} id="{{ $id }}" name="{{ $name }}"
    @required($required) @disabled($disabled)>

    {{ $slot }}

</select>