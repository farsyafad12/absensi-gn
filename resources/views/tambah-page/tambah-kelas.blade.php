@extends('layouts.main')

@section('container')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Tambah Kelas</h5>
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('buat_kelas')}}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="wali" class="form-label">Wali Kelas</label>
                                            <input type="text" name="wali" id="wali" class="form-control" placeholder="Nama Wali Kelas" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kelas" class="form-label">Nama Kelas</label>
                                            <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Nama Kelas" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tingkat" class="form-label">Tingkat<span class="text-danger">*</span></label>
                                            <select name="tingkat" id="tingkat" class="form-select" required>
                                                <option selected disabled>-- Pilih Tingkat --</option>
                                                @foreach ($tingkat as $tk)
                                                    <option value="{{ $tk->id_tingkat }}">{{ $tk->nama_tingkat }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <a href="{{ route('data_kelas') }}" class="btn btn-danger me-2">Batal</a>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            @endsection