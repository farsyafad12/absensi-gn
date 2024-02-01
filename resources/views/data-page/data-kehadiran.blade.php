@extends('layouts.main')

@section('container')
    @include('layouts.modal-kehadiran')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-2">Filter Data Siswa</h5>
            <p class="mb-4">Mencari Data Siswa Lebih Mudah Dengan Filter</p>
            <div class="container row">
                <div class="col-6">
                    <select name="kelas" id="kelas" class="form-select" onchange="filterkelas()">
                        <option value="" selected>-- Semua Kelas --</option>
                        @foreach ($kelasList as $kl)
                            <option value="{{ $kl->id_kelas }}">{{ $kl->kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <select name="tingkat" id="tingkat" class="form-select" onchange="filtertingkat()">
                        <option value="" selected>-- Semua Tingkat --</option>
                        @foreach ($tingkat as $tk)
                            <option value="{{ $tk->id_tingkat }}">{{ $tk->nama_tingkat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-danger fs-4 mt-2" id="pesan">
                </div>
                <div class="col-4 mt-3">
                    <label for="tanggal-kehadiran">Tanggal Absen :</label>
                    <input class="form-control" id="tanggal-kehadiran" type="date" name="tanggal-kehadiran"
                        onchange="filtertanggal()" onload="filtertanggal()" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Siswa</h5>
                    <a href="{{ route('data_siswa') }}" class="btn btn-primary"><i class="ti ti-article me-2"></i>Lihat Data
                        Siswa</a>
                </div>
                <div class="card-body p-4">
                    {{-- <div class="group w-100 mb-4">
                        <i class="ti ti-search icon"></i>
                        <input type="search" class="form-search w-100" id="search" onkeyup="search()"
                            placeholder="Cari Data" title="Cari Data Dari Tabel">
                    </div> --}}
                    <div class="table-responsive">
                        {{-- @include('data-page.list-data-kehadiran') --}}
                        <div id="hasilFilter">
                            <p class="text-danger text-center">Text Ini Akan Hilang Jika Tidak Ada Error dalam beberapa
                                detik, Jika Masih Muncul Coba Muat Ulang Halaman Atau Hubungi Pengelola.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var kelasTerpilih;
        var tanggalTerpilih;

        document.addEventListener('DOMContentLoaded', function() {
            var todayDateInput = document.getElementById('tanggal-kehadiran');
            var today = new Date().toISOString().split('T')[0];
            var submitButton = $('#submitBtn');
            submitButton.prop({
                'disabled': true,
                'type': 'button'
            });
            todayDateInput.value = today;
            kelasTerpilih = document.getElementById('kelas').value;
            tanggalTerpilih = document.getElementById('tanggal-kehadiran').value;
            if (kelasTerpilih !== undefined && tanggalTerpilih !== undefined) {
                filterAbsensi();
            }
        });

        function filterkelas() {
            kelasTerpilih = document.getElementById('kelas').value;
            console.log(kelasTerpilih);
            if (kelasTerpilih !== undefined && tanggalTerpilih !== undefined) {
                filterAbsensi();
            }
        }

        function filtertanggal() {
            tanggalTerpilih = document.getElementById('tanggal-kehadiran').value;
            console.log(tanggalTerpilih);
            if (kelasTerpilih !== undefined && tanggalTerpilih !== undefined) {
                filterAbsensi();
            }
        }
    </script>

    <script>
        function filterAbsensi() {
            console.log('data telah diproses ....');
            var tanggal = $('#tanggal-kehadiran').val();
            var kelas = $('#kelas').val();
            var tingkat = $('#tingkat').val();

            $.ajax({
                url: '/filter-absensi',
                type: 'GET',
                data: {
                    tanggal: tanggal,
                    kelas: kelas,
                },
                success: function(response) {
                    $('#hasilFilter').html(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection

@section('inlinefile')
    <script src="/assets/js/sidebarmenu.js"></script>
@endsection
