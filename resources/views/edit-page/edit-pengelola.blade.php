@extends('layouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Akun Pengelola</h5>
            <div class="card">
                <div class="card-body">
                    @if ($user->status !== 'selamanya')
                        <form method="post" action="{{ route('user_update', $user->id) }}">
                        @else
                            <form method="#" action="#">
                    @endif
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="username" class="form-label">Nama Pengguna<span class="text-danger">*</span></label>
                        @if ($user->status !== 'selamanya')
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="Nama Pengguna" value="{{ $user->username }}" required>
                        @else
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="Nama Pengguna" value="{{ $user->username }}" disabled>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email<span class="text-danger">*</span></label>
                        @if ($user->status !== 'selamanya')
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan Email" value="{{ $user->email }}" required>
                        @else
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan Email" value="{{ $user->email }}" disabled>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Akses Akun<span class="text-danger">*</span></label>
                        @if ($user->status !== 'selamanya')
                            <select name="role" id="role" class="form-select" required>
                                @foreach ($role as $role)
                                    <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <select name="role" id="role" class="form-select" disabled>
                                @foreach ($role as $role)
                                    <option disabled>-- Pilih Akses --</option>
                                    <option value="{{ $role }}" {{ $user->role == $role ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        @if ($user->status !== 'selamanya')
                            <input type="password" class="form-control" name="password" id="password" pattern="(?=.*[A-Z])(?=.*\d).{8,}" title="Minimal 8 Karakter, 1 Huruf Besar Dan 1 Angka"
                                placeholder="Masukkan Password Baru [ Tidak Wajib ]">
                        @else
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Masukkan Password Baru [ Tidak Wajib ]" disabled>
                        @endif
                    </div>
                    <a href="{{ route('user_detail') }}" class="btn btn-danger me-2">Batal</a>
                    @if ($user->status !== 'selamanya')
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    @else
                        <button type="button" class="btn btn-primary" disabled>Simpan Perubahan</button>
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
