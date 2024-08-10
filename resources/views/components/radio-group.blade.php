@foreach ($radios as $id => $radio)
    <div class="form-check form-check-inline">
        <x-input-radio
            :id="$id"
            :name="$name"
            :value="$radio['value']"
            :label="$radio['label']"
            :checked="$radio['checked'] ?? false" />
    </div>
@endforeach
