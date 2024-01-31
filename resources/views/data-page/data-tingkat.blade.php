@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Tingkat</h5>
                    <a href="tambah-tingkat" class="btn btn-primary"><i class="ti ti-plus me-2"></i>Tambah Tingkat</a>
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
                                        <h6 class="fw-semibold mb-0">Tingkat</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Jumlah Kelas</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Dibuat Pada</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Aksi</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tingkat as $t)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $t->nama_tingkat }}</h6>
                                            <span class="fw-normal">SIT Gema Nurani</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $t->kelas->count() }} Kelas</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span
                                                    class="badge bg-primary rounded-3 fw-semibold">{{ $t->created_at->format('Y-m-d H:i:s') }}</span>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                          @if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'administrator'))
                                          <form id="form-delete" action="{{ route('tingkat_delete', $t->id_tingkat) }}" method="post">
                                              @csrf
                                              @method('DELETE')
                                              <button type="button" class="btn btn-warning m-1"
                                                  onclick="window.location.href = '{{ route('tingkat_edit', $t->id_tingkat) }}';">Edit</button>
                                              @if (Auth::check() && Auth::user()->role == 'administrator')
                                              <button type="submit"
                                              class="btn btn-danger m-1" onclick="return confirmDelete()">Delete</button>
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
                                        <td colspan="5" class="text-center">Tidak Ada Data Tingkat Yang Tersedia</td>
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
