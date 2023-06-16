@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex justify-content-between">
                            <div class="form-group me-3">
                                <label for="monthly">Bulan</label>
                                <select class="form-control text-sm" name="monthly" id="monthly">
                                    <option value="">-- Pilih Bulan --</option>
                                    @foreach ($months as $month)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="me-3">
                                <x-input type="date" name="start_date" id="start_date" label="Tanggal Awal" />
                            </div>
                            <div class="me-3">
                                <x-input type="date" name="end_date" id="end_date" label="Tanggal Akhir" />
                            </div>
                            <div class="my-auto">
                                <button type="button" id="btnFilter" class="btn btn-primary py-2">
                                    Filter Range Tanggal
                                </button>
                            </div>
                        </div>
                    </div>
                    <table class="table" id="orderTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Metode Pembayaran</th>
                                <th>Pelanggan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                <th>Penerima</th>
                                <th>No. Telefon</th>
                                <th>Bukti Pembayaran</th>
                                <th>Biaya Pengiriman</th>
                                <th>Total Pembayaran</th>
                                <th>Alamat</th>
                                <th>Tanggal</th>
                                <th>Detail Pesanan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Upload Bukti Pembayaran -->
    <div class="modal fade" id="uploadPayment" tabindex="-1" role="dialog" aria-labelledby="uploadPaymentLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadPaymentLabel">Uplod Bukti Penerimaan Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <x-input type="file" name="proof_of_receipt" id="proof_of_receipt" label="Bukti Pembayaran"
                        required />
                    <img src="" alt="" id="proof_of_receipt_preview" class="img-fluid mt-2"
                        style="display: none">
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary" id="btnUpload">Upload</button>
                </div>
            </div>
        </div>
    </div>

    @push('js-internal')
        <script>
            function uploadPayment(id) {
                $('#uploadPayment').modal('show');
                $('input[name="id"]').val(id);
            }

            function changeStatus(id, status) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan mengubah status pesanan ini menjadi " + status +
                        "! Pesanan yang sudah dikonfirmasi tidak dapat dikembalikan lagi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'rgb(35, 53, 172)',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, saya yakin!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('admin.order.change-status') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id,
                                status: status,
                            },
                            success: function(response) {
                                if (response.status == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        text: response.message,
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        text: response.message,
                                    });
                                }
                            },
                        });
                    }
                })
            }

            $(function() {
                $('#orderTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.order.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'transaction_code',
                            name: 'transaction_code'
                        },
                        {
                            data: 'payment_method',
                            name: 'payment_method'
                        },
                        {
                            data: 'customer',
                            name: 'customer'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                        {
                            data: 'receiver',
                            name: 'receiver'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'proof_of_payment',
                            name: 'proof_of_payment',
                        },
                        {
                            data: 'shipping_cost',
                            name: 'shipping_cost'
                        },
                        {
                            data: 'total_payment',
                            name: 'total_payment'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'detail_transaction',
                            name: 'detail_transaction'
                        }
                    ],
                });

                $('#proof_of_receipt').change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#proof_of_receipt_preview').attr('src', e.target.result);
                        $('#proof_of_receipt_preview').show();
                    }
                    reader.readAsDataURL(this.files[0]);
                });

                $('#btnClose').click(function() {
                    $('#proof_of_receipt_preview').attr('src', '');
                    $('#proof_of_receipt').val('');
                    $('#proof_of_receipt_preview').hide();
                    $('#uploadPayment').modal('hide');
                });

                $('#btnUpload').click(function() {
                    let id = $('input[name="id"]').val();
                    let proof_of_receipt = $('#proof_of_receipt')[0].files[0];

                    if (proof_of_receipt == undefined) {
                        Swal.fire({
                            icon: 'error',
                            text: 'Bukti pembayaran tidak boleh kosong!',
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            text: 'Apakah Anda yakin ingin mengupload bukti pembayaran ini? Pesanan yang sudah dikonfirmasi tidak dapat dikembalikan lagi!',
                            showCancelButton: true,
                            confirmButtonColor: 'rgb(35, 53, 172)',
                            cancelButtonColor: '#aaa',
                            confirmButtonText: 'Ya, saya yakin!',
                            cancelButtonText: 'Batal',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let formData = new FormData();
                                formData.append('id', id);
                                formData.append('proof_of_receipt', proof_of_receipt);
                                formData.append('_token', '{{ csrf_token() }}');

                                $.ajax({
                                    url: '{{ route('admin.order.cod.upload-payment') }}',
                                    type: 'POST',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function(response) {
                                        if (response.status == 'success') {
                                            Swal.fire({
                                                icon: 'success',
                                                text: response.message,
                                            }).then(() => {
                                                window.location.reload();
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                text: response.message,
                                            });
                                        }
                                    },
                                });
                            } else {
                                $('#proof_of_receipt_preview').attr('src', '');
                                $('#proof_of_receipt').val('');
                                $('#proof_of_receipt_preview').hide();
                                $('#uploadPayment').modal('hide');
                            }
                        });
                    }
                });

                $('#monthly').change(function(e) {
                    e.preventDefault();
                    let monthlyIndex = $('#monthly option:selected').index();
                    $.ajax({
                        url: "{{ route('admin.order.filter-monthly') }}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            month: monthlyIndex,
                        },
                        success: function(response) {
                            $('#orderTable').DataTable().clear().destroy();
                            $('#orderTable').DataTable({
                                processing: true,
                                responsive: true,
                                autoWidth: false,
                                data: response.data,
                                columns: [{
                                        data: 'DT_RowIndex',
                                        name: 'DT_RowIndex',
                                        orderable: false,
                                        searchable: false
                                    },
                                    {
                                        data: 'transaction_code',
                                        name: 'transaction_code'
                                    },
                                    {
                                        data: 'payment_method',
                                        name: 'payment_method'
                                    },
                                    {
                                        data: 'customer',
                                        name: 'customer'
                                    },
                                    {
                                        data: 'status',
                                        name: 'status'
                                    },
                                    {
                                        data: 'action',
                                        name: 'action'
                                    },
                                    {
                                        data: 'receiver',
                                        name: 'receiver'
                                    },
                                    {
                                        data: 'phone',
                                        name: 'phone'
                                    },
                                    {
                                        data: 'proof_of_payment',
                                        name: 'proof_of_payment',
                                    },
                                    {
                                        data: 'shipping_cost',
                                        name: 'shipping_cost'
                                    },
                                    {
                                        data: 'total_payment',
                                        name: 'total_payment'
                                    },
                                    {
                                        data: 'address',
                                        name: 'address'
                                    },
                                    {
                                        data: 'created_at',
                                        name: 'created_at'
                                    },
                                    {
                                        data: 'detail_transaction',
                                        name: 'detail_transaction'
                                    }
                                ],
                            });
                        }
                    });
                });

                $('#btnFilter').click(function(e) {
                    e.preventDefault();
                    let start_date = $('#start_date').val();
                    let end_date = $('#end_date').val();
                    if (start_date == '' || end_date == '') {
                        Swal.fire({
                            icon: 'warning',
                            text: 'Pastikan range tanggal telah diisi!'
                        });
                    } else {
                        console.log(start_date, end_date);
                    }
                })
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
