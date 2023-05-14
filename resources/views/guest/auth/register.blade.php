@extends('guest.layout.master')
@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <h4>
                                {{ env('APP_NAME') }}
                            </h4>
                            <h6 class="fw-light">
                                Daftarkan diri anda untuk melanjutkan.
                            </h6>
                            <form class="pt-3" action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <x-input id="name" name="name" type="text" placeholder="Nama Lengkap" required/>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="sex" id="sex1"
                                                    value="1" checked="">
                                                Pria
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="sex" id="sex2"
                                                    value="2">
                                                Wanita
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <x-input id="avatar" name="avatar" type="file" placeholder="Foto Profil" required/>
                                <x-input id="phone" name="phone" type="text" placeholder="Nomor Telepon" required/>
                                <x-input id="address" name="address" type="text" placeholder="Alamat" required/>
                                <x-input id="email" name="email" type="email" placeholder="Email" required/>
                                <x-input id="password" name="password" type="password" placeholder="Password" required/>
                                <x-input id="password_confirmation" name="password_confirmation" type="password"
                                    placeholder="Konfirmasi Password" required/>
                                <div class="mt-3">
                                    <x-button type="submit">
                                        Daftar
                                    </x-button>
                                </div>
                                <div class="text-center mt-4 fw-light">
                                    Sudah punya akun?
                                    <a href="{{ route('login') }}" class="text-primary">
                                        Masuk
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection

@push('js-internal')
    <script>
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
