@props(['id' => null, 'name' => null, 'label' => null, 'value' => null, 'required' => false, 'placeholder' => ''])
<div class="form-group">
    <label for="{{ $id }}">{{ $label }}
        {!! $required ? '<span class="text-danger">*</span>' : '' !!}
    </label>
    <textarea class="form-control" id="{{ $id }}" name="{{ $name }}" rows="3"
        {{ $required ? 'required' : '' }} placeholder="{{ $placeholder }}">{{ $value }}</textarea>
</div>
