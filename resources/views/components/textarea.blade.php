@props(['id' => null, 'name' => null, 'label' => null, 'value' => null, 'required' => false])
<div class="form-group">
    <label for="{{ $id }}">{{ $label }}
        {!! $required ? '<span class="text-danger">*</span>' : '' !!}
    </label>
    <textarea class="form-control" id="{{ $id }}" name="{{ $name }}" rows="4">{{ $value }}</textarea>
</div>
