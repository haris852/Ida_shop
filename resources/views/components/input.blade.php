@props(['disable' => false, 'type' => 'text', 'name' => '', 'placeholder' => '', 'id' => '', 'value' => '', 'required' => false])
<div class="form-group">
    <input type="{{ $type }}" name="{{ $name }}" class="form-control form-control-lg"
        id="{{ $id }}" placeholder="{{ $placeholder }}" value="{{ $value }}"
        {{ $disable ? 'disabled' : '' }} autocomplete="off" {{
        $required ? 'required' : '' }} />

    @error($name)
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
