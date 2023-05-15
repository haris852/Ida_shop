@if ($data->is_active == 1)
    <span class="d-flex align-items-center">
        <span class="me-1 mdi mdi-check-circle text-success"></span>
        Aktif
    </span>
@else
    <span class="d-flex align-items-center">
        <span class="me-1 mdi mdi-close-circle text-danger"></span>
        Nonaktif
    </span>
@endif
