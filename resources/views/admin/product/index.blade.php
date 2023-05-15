@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="productTable" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Berat</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Status</th> {{-- 1 = aktif, 0 = nonaktif --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('js-internal')
        <script>
            $(function() {
                // disable twice init
                if ($.fn.dataTable.isDataTable('#productTable')) {
                    $('#productTable').DataTable().destroy();
                }
                $('#productTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.product.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'category',
                            name: 'category'
                        },
                        {
                            data: 'weight',
                            name: 'weight'
                        },
                        {
                            data: 'stock',
                            name: 'stock'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });
        </script>
    @endpush
@endsection
