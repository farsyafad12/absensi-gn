@extends('layouts.main')

@section('container')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Tambah Siswa Baru</h5>
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('buat_siswa')}}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Siswa<span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Lengkap Siswa" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nisn" class="form-label">Nisn<span class="text-danger">*</span></label>
                                            <input type="number" min="9" name="nisn" id="nisn" class="form-control" placeholder="Nisn Siswa" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin<span class="text-danger">*</span></label>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                                <option selected disabled>-- Pilih Jenis Kelamin --</option>
                                                @foreach ($jenis_kelamin as $jenis)
                                                    <option value="{{ $jenis }}">{{ $jenis }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kelas" class="form-label">Kelas<span class="text-danger">*</span></label>
                                            <select name="kelas" id="kelas" class="form-select" required>
                                                <option disabled selected>-- Pilih Kelas --</option>
                                                @foreach ($kelasList as $kl)
                                                    <option value="{{ $kl->id_kelas }}">{{ $kl->kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <a href="{{ route('data_siswa') }}" type="button" class="btn btn-danger me-2">Batal</a>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            @endsection