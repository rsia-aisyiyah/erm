<input type="text"
       {{ $attributes->merge(['class' => 'form-control form-control-sm']) }}
       @if ($attributes->has('style') && !empty($attributes->get('style')))
           {{ $attributes->merge(['style' => $attributes->get('style')]) }}

       @endif
       id="{{ $id }}"
       name="{{ $name }}"
       placeholder="{{ $placeholder }}"
       onfocus="removeZero(this)"
       onblur="cekKosong(this)"
       value="{{ $value ?? '-' }}"
       autocomplete="off"
       {{$readonly ?? ''}}
/>
