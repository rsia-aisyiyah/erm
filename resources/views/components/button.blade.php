<button
{{--        {{ $attributes->merge(['class' => 'btn']) }}--}}
{{--        {{$attributes->merge(['class' => 'btn btn-sm'])}}--}}
        @if($attributes->has('style') && !empty($attributes->get('style')))
                {{ $attributess->merge(['style' => $attributess->get('style')]) }}
        @endif
        id="{{$id}}"
>
{{$slot}}
</button>