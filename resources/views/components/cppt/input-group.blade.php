<div class="input-group">
    <x-cppt.input :align="$align"
        :name="$name"
        :value="$value"
        :id="$id"
        :border="$border"
        :style="$style" />
    <label for="{{ $id }}" class="input-group-text bg-white border-left-0">{{ $label }}</label>
</div>
