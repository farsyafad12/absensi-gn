@extends('layouts.error-page')

@section('container')
    <div class="text-nowrap logo-img text-center d-block w-100">
        <img src="/assets/images/logos/404-error.jpg" width="180" alt="logo-gema-nurani">
    </div>
    <div class="container text-center">
        <h4>404 Not Found</h4>
        <p class="fs-4">Maaf, Halaman Tidak Ditemukan Atau Telah Dipindahkan</p>
        <div class="">
        <a href="{{ route('dashboard') }}" type="button" class="btn btn-dark m-1">Kembali Ke Halaman Utama</a>
        <a href="https://wa.me/6288293898965" target="_blank" type="button" class="btn btn-info m-1"><i class="ti ti-phone me-2"></i>Hubungi Pengelola</a>
    </div>
    </div>
@endsection
