@extends('admin.layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <img src="{{ asset('assets/image/defaultmenu.jpg') }}" alt="menu image" id="thumbnail"
                                    class="img-lg rounded mb-3 object-fit-cover">
                                <button class="btn btn-primary mt-2" id="btnUpload">
                                    Upload Foto
                                </button>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="{{ route('admin.product.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="image" id="image" class="d-none">
                                        <x-input id="name" type="text" name="name" label="Nama Produk"
                                            required />
                                        <x-input id="weight" type="number" name="weight" label="Berat (gram)"
                                            required />
                                        <div class="form-group">
                                            <label for="category">Kategori</label>
                                            <div class="form-group row">
                                                <div class="col-sm-4">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="category"
                                                                id="meat" value="meat" checked="">
                                                            Daging
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="category"
                                                                id="seafood" value="seafood">
                                                            Seafood
                                                            <i class="input-helper"></i></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <x-input id="stock" type="number" name="stock" label="Stok" required />
                                    <x-input id="price" type="number" name="price" label="Harga" required />
                                    <x-input id="description" type="text" name="description" label="Deskripsi"
                                        required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js-internal')
        <script>
            $(function() {
                $('#btnUpload').on('click', function(e) {
                    e.preventDefault();
                    $('#image').trigger('click');

                    $('#image').on('change', function() {
                        let file = $(this).prop('files')[0];
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            $('#thumbnail').attr('src', e.target.result);
                            $('#btnUpload').text('Ubah Foto');
                        }
                        reader.readAsDataURL(file);
                    });
                });
            });

            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ Session::get('success') }}',
                })
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ Session::get('error') }}',
                })
            @endif
        </script>
    @endpush
@endsection
