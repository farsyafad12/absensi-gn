@extends('layouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Detail Siswa</h5>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('siswa_update', $siswa->id_siswa) }}">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Siswa<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Nama Lengkap Siswa" value="{{ $siswa->nama_siswa }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nisn" class="form-label">Nisn<span class="text-danger">*</span></label>
                            <input type="number" min="9" name="nisn" id="nisn" class="form-control"
                                placeholder="Masukkan NISN Siswa" value="{{ $siswa->nisn }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                                <option disabled>-- Pilih Kelas --</option>
                                @foreach ($jenis_kelamin as $jenis)
                                    <option value="{{ $jenis }}"
                                        {{ $jenis == $siswa->jenis_kelamin ? 'selected' : '' }}>
                                        {{ $jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas<span class="text-danger">*</span></label>
                            <select id="kelas" name="kelas" class="form-select" required>
                                <option disabled>-- Pilih Kelas --</option>
                                @foreach ($kelasList as $kl)
                                    <option value="{{ $kl->id_kelas }}"
                                        {{ $kl->id_kelas == $siswa->id_kelas ? 'selected' : '' }}>
                                        {{ $kl->kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('data_siswa') }}" class="btn btn-danger me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
