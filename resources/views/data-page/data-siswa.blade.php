@extends('layouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold">Filter Data Siswa</h5>
            <p class="mb-4">Mencari Data Siswa Lebih Mudah Dengan Filter</p>
            <div class="container d-flex align-items-center justify-content-center text-center row">
                <div class="col-6">
                    <select name="kelas" id="kelas" class="form-select" onchange="filterData()">
                        <option value="" selected>-- Semua Kelas --</option>
                        @foreach ($kelasList as $kl)
                        <option value="{{ $kl->kelas }}">{{ $kl->kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <select name="tingkat" id="tingkat" class="form-select" onchange="filterData()">
                        <option value="" selected>-- Semua Tingkat --</option>
                        @foreach ($tingkat as $tk)
                        <option value="{{ $tk->nama_tingkat }}">{{ $tk->nama_tingkat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-danger fs-4 mt-2" id="pesan">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Siswa</h5>
                    <a href="{{ route('tambah_siswa') }}" class="btn btn-primary"><i class="ti ti-plus me-2"></i>Tambah Siswa</a>
                </div>
                <div class="card-body">
                    <div class="group w-100 mb-4">
                        <i class="ti ti-search icon"></i>
                        <input type="search" class="form-search w-100" id="search" onkeyup="search()"
                            placeholder="Cari Data" title="Cari Data Dari Tabel">
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle" id="table">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Nama Lengkap</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Kelas</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Jenis Kelamin</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Nisn</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Aksi</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswa as $s)
                                    <tr class="data" data-kelas="{{ $s->kelas->kelas }}"
                                        data-tingkat="{{ $s->kelas->tingkat->nama_tingkat }}">
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $s->nama_siswa }}</h6>
                                            <span class="fw-normal">{{ $s->kelas->tingkat->nama_tingkat }}</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $s->kelas->kelas }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $s->jenis_kelamin }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span
                                                    class="badge bg-primary rounded-3 fw-semibold">{{ $s->nisn }}</span>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                            @if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'administrator'))
                                                <form id="form-delete" action="{{ route('siswa_delete', $s->id_siswa) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('siswa_edit', $s->id_siswa) }}" class="btn btn-warning m-1">Edit</a>
                                                    @if (Auth::check() && Auth::user()->role == 'administrator')
                                                        <button type="submit" class="btn btn-danger m-1"
                                                            onclick="return confirmDelete()">Delete</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger m-1"
                                                            disabled>Delete</button>
                                                    @endif
                                                </form>
                                            @else
                                                <button type="button" class="btn btn-warning m-1" disabled>Edit</button>
                                                <button type="button" class="btn btn-danger m-1" disabled>Delete</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">Tidak Ada Data Siswa Yang Tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('inlinefile')
<script src="/assets/js/sidebarmenu.js"></script>
<script src="/assets/js/searchmenu.js"></script>
@endsection