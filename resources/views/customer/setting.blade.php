@extends('customer.layout.master')
@section('content')
    <!-- Menu -->
    <div class="text-center mt-5 mb-3">
        <h4 class="font-weight-bold">Pengaturan</h4>
        <p>
            <a href="{{ route('home') }}" class="text-decoration-none">Beranda</a> / Pengaturan
        </p>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row pt-4">
                        <div class="col-lg-4">
                            <div class="text-center">
                                <img src="{{ auth()->user()->avatar ? asset('storage/avatar/' . auth()->user()->avatar) : asset('assets/image/defaultuser.jpg') }}"
                                    alt="profile" id="thumbnail" class="img-md rounded-circle mb-3" width="100"
                                    height="100">
                                <div class="mb-3">
                                    <h5>
                                        {{ Auth::user()->name }}
                                    </h5>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h6 class="mb-0 me-2 text-muted">
                                            {{ Auth::user()->email }}
                                        </h6>
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-2" onclick="changePicture()">
                                    Ubah Foto
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <h5>
                                Informasi Akun
                            </h5>
                            <form action="{{ route('user.setting.update', auth()->user()->id) }}" method="POST"
                                class="mt-4" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="d-none">
                                    <x-input id="avatar" name="avatar" type="file" label="Foto"
                                        placeholder="Masukkan foto" />
                                </div>
                                <x-input id="name" name="name" type="text" label="Nama"
                                    value="{{ Auth::user()->name }}" placeholder="Masukkan nama" required />
                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sex" id="1"
                                            value="1" {{ auth()->user()->sex == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="1">
                                            Pria
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sex" id="2"
                                            value="2" {{ auth()->user()->sex == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="2">
                                            Wanita
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <x-input id="phone" name="phone" type="text" label="No. Telepon"
                                            placeholder="Nomor Telepon" value="{{ Auth::user()->phone }}" required />
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <label for="address">Alamat</label>
                                            <textarea class="form-control" id="address" name="address" rows="4" required>{{ auth()->user()->address }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                {{-- divider --}}
                                <div class="border-bottom my-4"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-input id="email" name="email" type="email" label="Email"
                                            value="{{ Auth::user()->email }}" placeholder="Masukkan email" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-input id="old_password" name="old_password" type="password" label="Password Lama"
                                            placeholder="Masukkan password lama" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-input id="new_password" name="new_password" type="password"
                                            label="Password Baru" />
                                    </div>
                                    <div class="col-md-6">
                                        <x-input id="new_password_confirmation" name="new_password_confirmation"
                                            type="password" label="Konfirmasi Password Baru" />
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
            function changePicture() {
                $('#avatar').click();

                $('#avatar').change(function() {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#thumbnail').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            }

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
