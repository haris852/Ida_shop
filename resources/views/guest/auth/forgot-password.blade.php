@extends('guest.layout.master')
@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <h5 class="mb-4">
                                Formulir reset kata sandi
                            </h5>
                            <form action="" method="POST">
                                @csrf
                                <x-input id="email" label="Masukan alamat email kamu" name="email" type="email"
                                    required />
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('login') }}" class="py-1 text-decoration-none text-gray">
                                        Kembali
                                    </a>
                                    <x-button type="submit" class="py-1">
                                        Kirim
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js-internal')
        <script>

            $(function () {
                // when button click submit form show loading popup
                $('form').submit(function () {
                    $('button[type=submit]').html('<i class="fa fa-spinner fa-spin"></i> Mengirim link...').attr('disabled',
                        true);
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
