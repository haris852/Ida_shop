@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="userTable" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>No. HP</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Role</th>
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
            function btnDelete(id, name) {
                let url = "{{ route('admin.user.destroy', ':id') }}";
                url = url.replace(':id', id);
                Swal.fire({
                    icon: 'warning',
                    text: `Apakah anda yakin ingin menghapus user ${name} dengan id ${id}?`,
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.status) {
                                    Swal.fire({
                                        icon: 'success',
                                        text: response.message,
                                    }).then(() => {
                                        $('#userTable').DataTable().ajax.reload(null, false);
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        text: response.message,
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    text: xhr.responseJSON.message,
                                });
                            }
                        });
                    }
                });
            }

            $(function() {
                $('#userTable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.user.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'role',
                            name: 'role'
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

            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    text: "{{ Session::get('success') }}",
                })
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    text: "{{ Session::get('error') }}",
                })
            @endif
        </script>
    @endpush
@endsection
