@props(['disable' => false, 'type' => 'text', 'name' => '', 'placeholder' => '', 'id' => '', 'value' => '', 'required' => false, 'label' => '', 'disabled' => false, 'readonly' => false])
<div class="form-group">
    <label for="{{ $id }}">{{ $label }}
        {!! $required ? '<span class="text-danger">*</span>' : '' !!}
    </label>
    <input type="{{ $type }}" id="{{ $id }}" placeholder="{{ $placeholder }}" name="{{ $name }}"
        value="{{ $value }}" class="ps-3 form-control @error($name) is-invalid @enderror"
        {{ $required ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }} {{
            $readonly ? 'readonly' : ''
        }}>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
