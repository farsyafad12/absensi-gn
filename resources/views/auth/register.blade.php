@extends('layouts.account')

@section('container')
    @include('layouts.alert')
    <form action="{{ route('actionregister') }}" method="post">
        @csrf
        <div class="mb-2">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Buat Username" required="">
        </div>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Nama Email"
                required="">
        </div>
        <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Buat Password Akun"
                required="">
        </div>
        <button type="submit" class="btn btn-primary w-100 py-2 fs-4 mb-4 mt-2 rounded-2">Daftar</button>
        <div class="d-flex align-items-center justify-content-center">
            <p class="fs-3 mb-0 fw-bold">Sudah Punya Akun?</p>
            <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Login</a>
        </div>
    </form>
@endsection
