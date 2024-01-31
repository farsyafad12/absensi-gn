@extends('layouts.main')

@section('container')
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">Tambah Tingkat</h5>
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('buat_tingkat')}}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Tingkat</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama Tingkat" value="" required>
                                        </div>
                                        <button type="button" class="btn btn-danger me-2" onclick="window.history.back()">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            @endsection