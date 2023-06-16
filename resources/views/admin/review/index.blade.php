@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="reviewTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No. Invoice</th>
                                <th>Rating</th>
                                <th>Ulasan</th>
                                <th>Reviewer</th>
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
                $('#reviewTable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: '{{ route('admin.review.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'invoice_number',
                            name: 'invoice_number'
                        },
                        {
                            data: 'rating',
                            name: 'rating'
                        },
                        {
                            data: 'review',
                            name: 'review'
                        },
                        {
                            data: 'user',
                            name: 'user'
                        }
                    ]
                })
            });
        </script>
    @endpush
@endsection
