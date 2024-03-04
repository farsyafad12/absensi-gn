@extends('layouts.account')

@section('container')
    <div class="container">
        <h6 class="fs-4 text-center mt-3 mb-2">{{ $title }} Database Siswa</h6>
        @include('layouts.alert')
        <form action="{{ route('actionregister') }}" method="post">
            @csrf
            <div class="mb-2">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Buat Username" required>
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Nama Email"
                    required>
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Buat Password Akun"
                    required>
            </div>
            <button type="submit" class="btn btn-success w-100 py-2 fs-4 mb-4 mt-2 rounded-2">Daftar</button>
            <div class="d-flex align-items-center justify-content-center">
                <p class="fs-3 mb-0 fw-bold">Sudah Punya Akun?</p>
                <a class="text-info fw-bold ms-2" href="{{ route('login') }}">Masuk Sekarang</a>
            </div>
        </form>
    </div>
@endsection
