@extends('layouts/blankLayout')

@section('title', 'Lupa Password')

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <!-- Lupa Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <img src="logo.jpg" alt="kerapatan-gereja-protestan-minahasa" width="100">
                            <h4 class="mt-3 ms-4">Kerapatan Gereja Protestan Minahasa</h4>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Lupa Password ? 🔒</h4>
                        <p class="mb-4">Masukkan email dan kami akan mengirimkan password baru ke email anda</p>
                        <form id="formAuthentication" class="mb-3" action="/lupa-password" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Masukkan email anda" autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary d-grid w-100">Kirim Password Baru ke Email</button>
                        </form>
                        <div class="text-center">
                            <a href="/" class="d-flex align-items-center justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                Kembali ke login
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error'
            });
        @elseif (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success'
            });
        @endif
    </script>
@endsection
