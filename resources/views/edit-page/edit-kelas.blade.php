@extends('layouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Kelas</h5>
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('kelas_update', $kelas->id_kelas) }}">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="wali" class="form-label">Wali Kelas</label>
                            <input type="text" id="wali" name="wali" class="form-control"
                                placeholder="Nama Wali Kelas" value="{{ $kelas->wali_kelas }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Edit Nama Kelas</label>
                            <input type="text" id="kelas" name="kelas" class="form-control"
                                placeholder="Nama Kelas" value="{{ $kelas->kelas }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tingkat" class="form-label">Tingkat</label>
                            <select id="tingkat" name="tingkat" class="form-select" required>
                                <option disabled>-- Pilih Tingkat --</option>
                                @foreach ($tingkat as $tk)
                                    <option value="{{ $tk->id_tingkat }}"
                                        {{ $tk->id_tingkat == $kelas->id_tingkat ? 'selected' : '' }}>
                                        {{ $tk->nama_tingkat }}
                                    </option>
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
