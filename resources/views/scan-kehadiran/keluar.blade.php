@extends('layouts.scan')

@section('container')
    <div class="container text-center d-flex align-items-center flex-column mb-2">
        <div class="btn-group mb-3">
            <a href="{{ route('scan_masuk') }}"
                class="btn btn-primary {{ request()->url() == route('scan_masuk') ? ' active' : '' }}"
                aria-current="page">Scan Masuk</a>
            <a href="{{ route('scan_keluar') }}"
                class="btn btn-primary {{ request()->url() == route('scan_keluar') ? ' active' : '' }}"
                aria-current="page">Scan Pulang</a>
        </div>
        @include('layouts.alert-kehadiran')
        <!--<div id="preview" class="rounded-2 shadow-lg mb-2 p-3 bg-primary-subtle w-75" style="height: 175px;overflow: hidden;">
                                                                                        </div>-->
        <div>
            <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
        </div>

        <div id="sourceSelectPanel" class="mb-2 d-flex align-items-center gap-3 mt-2" style="display: none;">
            <label for="sourceSelect">Ubah Sumber Kamera : </label>
            <select class="form-select" id="sourceSelect" style="max-width: 200px;"
                title="Detail Spesifikasi Kamera Yang Sedang Digunakan">
            </select>
        </div>

        <div class="row text-center d-flex justify-content-between w-100 mb-1">
            <div class="col-6">Nama Siswa : <span id="namaSiswa">null</span></div>
            <div class="col-6">Nisn : <span id="nisn">null</span></div>
        </div>
        <div class="row text-center d-flex justify-content-between w-100">
            <div class="col-6">Jam Masuk : <span id="jamMasuk">null</span></div>
            <div class="col-6">Jam Pulang : <span id="jamKeluar">null</span></div>
        </div>
    </div>
@endsection
