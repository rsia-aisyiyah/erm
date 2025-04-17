@foreach ($checkboxes as $id => $check)
    <div {{ $attributes->merge(['class' => 'form-check me-3']) }}>
        <x-checkbox
            :id="$id"
            :name="$name"
            :value="$check['value']"
            :label="$check['label']"
            :checked="$check['checked'] ?? false" />
    </div>
@endforeach
