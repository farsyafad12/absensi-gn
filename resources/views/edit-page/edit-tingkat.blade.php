@extends('layouts.main')

@section('container')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Edit Tingkat</h5>
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="{{ route('tingkat_update', $tingkat->id_tingkat) }}">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="nama_tingkat" class="form-label">Nama Tingkat</label>
                                            <input type="text" id="nama_tingkat" name="nama_tingkat" class="form-control" placeholder="Masukkan Nama Tingkat" value="{{ $tingkat->nama_tingkat }}">
                                        </div>
                                        <button type="button" class="btn btn-danger me-2" onclick="window.history.back()">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            @endsection