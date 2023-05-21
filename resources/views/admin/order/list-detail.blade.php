@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="listDetailTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No. Invoice</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                                <th>Tanggal</th>
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
                $('#listDetailTable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    dom: 'Bfrtip',
                    buttons: [
                        [
                            {
                                extend: 'print',
                                text: '<i class="far fa-file-pdf"></i> PRINT',
                                titleAttr: 'Export as PDF',
                                title: 'Detail Order',
                                customize: function(doc) {
                                    $(doc.document.body).find('h1').css('text-align', 'center');
                                    $(doc.document.body).find('h1').css('font-weight', 'bold');
                                    $(doc.document.body).find('h1').css('font-size', '14px');
                                    $(doc.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                }
                            },
                        ]
                    ],
                    ajax: "{{ route('admin.order.list-detail') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'invoice_code',
                            name: 'invoice_code'
                        },
                        {
                            data: 'product_name',
                            name: 'product_name'
                        },
                        {
                            data: 'qty',
                            name: 'qty'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'subtotal',
                            name: 'subtotal'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        }
                    ]
                });
            });
        </script>
    @endpush
@endsection
