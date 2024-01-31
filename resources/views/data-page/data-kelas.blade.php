@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Kelas</h5>
                    <a href="tambah-kelas" class="btn btn-primary"><i class="ti ti-plus me-2"></i>Tambah Kelas</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Wali Kelas / Tingkat</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Kelas</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Jumlah Siswa</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Aksi</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kelas as $c)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $c->wali_kelas }}</h6>
                                            <span class="fw-normal">{{ $c->tingkat->nama_tingkat }}</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $c->kelas }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <p class="mb-0 fw-normal">{{ $c->siswa->count() }} Siswa</p>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                            @if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'administrator'))
                                                <form id="form-delete" action="{{ route('kelas_delete', $c->id_kelas) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-warning m-1"
                                                        onclick="window.location.href = '{{ route('kelas_edit', $c->id_kelas) }}';">Edit</button>
                                                    @if (Auth::check() && Auth::user()->role == 'administrator')
                                                    <button type="submit"
                                                    class="btn btn-danger m-1" onclick="return confirmDelete()">Delete</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger m-1"
                                                            disabled>Delete</button>
                                                    @endif
                                                    @include('layouts.modal-delete')
                                                </form>
                                            @else
                                                <button type="button" class="btn btn-warning m-1" disabled>Edit</button>
                                                <button type="button" class="btn btn-danger m-1" disabled>Delete</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak Ada Data Kelas Yang Tersedia</td>
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
