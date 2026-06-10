<option {{ $attributes }} value="{{ $value ?: trim($slot) }}" @selected($selected)>
    {{ $slot }}
</option>