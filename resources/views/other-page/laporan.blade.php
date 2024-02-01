@extends('layouts.main')

@section('container')
    <div class="card">
        <div class="card-header">
            <h5>Generate Laporan Kehadiran</h5>
            <p>Lihat Atau Download Dengan Format DOC Atau PDF</p>
        </div>
        <div class="card-body text-center">
            <h5>Laporan Absen Siswa</h5>
            <div class="d-flex flex-column align-items-center w-50 mx-auto gap-2 mb-4">
                <label for="bulan-laporan">Bulan :</label>
                <input type="month" name="bulan-laporan" id="bulan-laporan" class="month" onchange="cekData()">
            </div>
            <div class="d-flex flex-column align-items-center w-25 mx-auto gap-2 mb-3">
                <label for="kelas-qr">Kelas :</label>
                <select class="form-select px-4" name="kelas-qr" id="kelas-qr" onchange="cekData()">
                    <option selected>--Pilih Kelas--</option>
                    @foreach ($kelasList as $kl)
                        <option value="{{ $kl->id_kelas }}">{{ $kl->kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                {{-- <a href="result-laporan" class="btn btn-info m-1 w-25"><i class="ti ti-presentation-analytics me-2"></i>Lihat Laporan</a><br /> --}}
                <button class="btn btn-danger m-1" id="tombol" onclick="generate()" title="Silahkan Isi Filter Di Atas Terlebih Dahulu" disabled><i
                        class="ti ti-file me-2"></i>Generate
                    PDF</button><br />
                {{-- <button type="button" class="btn btn-primary m-1"><i class="ti ti-file me-2"></i>Generate DOC</button> --}}
            </div>
        </div>
    </div>
@endsection

@section('inlinefile')
    <script>
        var inputBulan = document.getElementById('bulan-laporan');
        var kelasSelect = document.getElementById('kelas-qr');
        var tombol = document.getElementById('tombol');

        function generate() {
            var bulanTahun = inputBulan.value.replace("-", "");
            var tahun = bulanTahun.substring(0, 4);
            var bulan = bulanTahun.substring(4);
            bulan = bulan.charAt(0) === '0' ? bulan.substring(1) : bulan;
            var selectedKelas = kelasSelect.value;
            window.location.href = "laporan/" + tahun + "/" + bulan + "/" + selectedKelas;
        }

        function cekData() {
            var bulanTahun = inputBulan.value.replace("-", "");
            var selectedKelas = kelasSelect.value;

            if (bulanTahun !== '' && selectedKelas !== '') {
                console.log(bulanTahun);
                tombol.removeAttribute('disabled');
                tombol.setAttribute('type', 'button');
            } else {
                console.log(bulanTahun);
                tombol.setAttribute('disabled', 'disabled');
                tombol.setAttribute('type', 'submit');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            cekData();
            inputBulan.addEventListener('input', cekData);
            kelasSelect.addEventListener('change', cekData);
        });
    </script>
@endsection
