@props(['type' => 'button', 'id' => '', 'value' => '', 'class' => '', 'onclick' => ''])
<button type="{{ $type }}" {!! $attributes->merge(['class' => 'btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn']) !!} id="{{ $id }}" onclick="{{ $onclick }}">
    {{ $slot }}
</button>
