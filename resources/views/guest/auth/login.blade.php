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
                                Masuk untuk melanjutkan.
                            </h6>
                            <form class="pt-3" action="{{ route('login.store') }}" method="POST">
                                @csrf
                                <x-input id="email" label="Email" name="email" type="email" placeholder="Email" required />
                                <x-input id="password" label="Kata sandi" name="password" type="password" placeholder="Password" required />
                                <div class="mt-3">
                                    <x-button type="submit">
                                        Masuk
                                    </x-button>
                                </div>
                                <div class="text-center mt-4 fw-light">
                                    Belum punya akun?
                                    <a href="{{ route('register') }}" class="text-primary">
                                        Buat
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
@endsection
