@extends('layouts.main')
@section('container')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Akun Pengelola</h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{route('create_user')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Nama Pengguna<span class="text-danger">*</span></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Buat Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Nama Email" required>
                            <!--<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>-->
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Buat Password<span class="text-danger">*</span></label>
                            <input type="password" pattern="(?=.*[A-Z])(?=.*\d).{8,}" class="form-control" name="password" id="password" title="Minimal 8 Karakter, 1 Huruf Besar Dan 1 Angka" placeholder="Buat Password Akun" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Akses<span class="text-danger">*</span></label>
                            <select name="role" id="role" class="form-select" required>
                                <option selected disabled>-- Pilih Akses --</option>
                                @foreach ($role as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('user_detail') }}" class="btn btn-danger me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
