@props(['type' => 'button', 'id' => '', 'value' => '', 'class' => '', 'onclick' => ''])
<button type="{{ $type }}" {!! $attributes->merge(['class' => 'btn btn-block btn-primary font-weight-medium']) !!} id="{{ $id }}" onclick="{{ $onclick }}">
    {{ $slot }}
</button>
