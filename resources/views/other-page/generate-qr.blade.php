@extends('layouts.main')

@section('container')
            <div class="alert alert-warning" role="alert">
                        <i class="ti ti-alert-triangle"></i>
                        Jika Tidak Download Otomatis, File Image Qr Code Akan Tersimpan Pada Folder Server /storage/app/public/qrcodes
                        </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-2">Generate Qr Code</h5>
                        <p class="mb-0">Genereate Qr Code Berdasarkan NISN Siswa</p>
                        <div class="container text-center">
                            <div class="row align-items-center mt-4">
                                <div class="col-12">
                                    <h5>Data Semua Siswa</h5>
                                    <p>Total Jumlah Semua Siswa : {{ $siswa }} Siswa</p>
                                    <a href="data-siswa" class="btn btn-outline-info m-1">Lihat Data Siswa</a>
                                    <a href="{{ route('generate') }}" class="btn btn-info m-1"><i class="ti ti-qrcode me-1"></i>Generate Qr Code</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 text-center"><span class="text-danger">*</span>Note : File QR Code Akan Disusun Dalam Folder Setiap kelas</p>
                </div>
            @endsection