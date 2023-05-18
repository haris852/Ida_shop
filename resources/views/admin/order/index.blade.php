@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="orderTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Metode Pembayaran</th>
                                <th>Pelanggan</th>
                                <th>Penerima</th>
                                <th>Aksi</th>
                                <th>No. Telefon</th>
                                <th>Bukti Pembayaran</th>
                                <th>Status</th>
                                <th>Biaya Pengiriman</th>
                                <th>Total Pembayaran</th>
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
            $(function () {
                $('#orderTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.order.index') }}',
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'transaction_code', name: 'transaction_code'},
                        {data: 'payment_method', name: 'payment_method'},
                        {data: 'customer', name: 'customer'},
                        {data: 'receiver', name: 'receiver'},
                        {data: 'action', name: 'action'},
                        {data: 'phone', name: 'phone'},
                        {data: 'proof_of_payment', name: 'proof_of_payment'},
                        {data: 'status', name: 'status'},
                        {data: 'shipping_cost', name: 'shipping_cost'},
                        {data: 'total_payment', name: 'total_payment'},
                        {data: 'created_at', name: 'created_at'},
                    ],
                });
            });

            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    text: '{{ Session::get('success') }}',
                })
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    text: '{{ Session::get('error') }}',
                })
            @endif
        </script>
    @endpush
@endsection
