@extends('layouts.main')

@section('container')
        <div class="card">
          <div class="card-header">
            <h5>Generate Laporan Kehadiran</h5>
            <p>Lihat Atau Download Dengan Format DOC Atau PDF</p>
          </div>
          <div class="card-body text-center">
            <h5>Laporan Absen Siswa</h5>
            <div class="d-flex justify-content-between align-items-center w-25 mx-auto gap-2 mb-2">
              <label for="bulan-laporan">Bulan :</label> 
              <input type="month" name="bulan-laporan" id="bulan-laporan" class="month">
            </div>
            <div class="d-flex justify-content-between align-items-center w-25 mx-auto gap-2">
              <label for="kelas-qr">Kelas :</label> 
              <select class="form-select w-auto" name="kelas-qr" id="kelas-qr">
                <option selected>--Pilih Kelas--</option>
                <option value="1">9A</option>
                <option value="2">9B</option>
              </select>
            </div>
            <div class="mt-2">
              <a href="result-laporan" class="btn btn-info m-1 w-25"><i class="ti ti-presentation-analytics me-2"></i>Lihat Laporan</a><br />
              <button type="button" class="btn btn-danger m-1 w-25"><i class="ti ti-file me-2"></i>Generate PDF</button><br />
              <button type="button" class="btn btn-primary m-1 w-25"><i class="ti ti-file me-2"></i>Generate DOC</button>
            </div>
          </div>
        </div>
      @endsection