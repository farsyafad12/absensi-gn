@extends('layouts.account')

@section('container')
@include('layouts.alert')
  <form action="{{ route('actionlogin') }}" method="post">
  @csrf
      <div class="mb-3">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="">
      </div>
      <div class="mb-3">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
      </div>
      <div class="d-flex align-items-center justify-content-between mb-4">
        <!--<div class="form-check">
          <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
          <label class="form-check-label text-dark" for="flexCheckChecked">
            Remeber this Device
          </label>
        </div>-->
        <!--<a class="text-primary fw-bold" href="#">Forgot Password ?</a>-->
      </div>
      <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Masuk</button>
      <div class="d-flex align-items-center justify-content-center">
        <p class="fs-3 mb-0 fw-bold">Belum Punya Akun?</p>
        <a class="text-primary fw-bold ms-2" href="register">Buat Akun Baru</a>
      </div>
  </form>
@endsection