@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Pengelola</h5>
                    @if (Auth::check() && (Auth::user()->role == 'administrator'))
                        <a href="{{ route('user_new') }}" class="btn btn-primary"><i class="ti ti-plus me-2"></i>Tambah
                            Pengelola</a>
                    @else
                        <button type="button" class="btn btn-primary" disabled><i class="ti ti-plus me-2"></i>Tambah
                            Pengelola</button>
                    @endif
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
                                        <h6 class="fw-semibold mb-0">Username Pengguna</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Akses</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Email</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Aksi</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $u)
                                    <tr>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                        </td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $u->username }}</h6>
                                            <span class="fw-normal">SIT Gema Nurani</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $u->role }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span
                                                    class="badge bg-primary rounded-3 fw-semibold">{{ $u->email }}</span>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                            @if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'administrator'))
                                                @if ($u->status !== 'selamanya')
                                                    @if (Auth::check() && Auth::user()->role == 'administrator')
                                                        <form id="form-delete" action="{{ route('user_delete', $u->id) }}"
                                                            method="post">
                                                        @else
                                                            <form id="form-delete" action="#">
                                                    @endif
                                                @else
                                                    <form id="form-delete" action="#">
                                                @endif
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('user_edit', $u->id) }}"
                                                    class="btn btn-warning m-1">Edit</a>
                                                @if ($u->status !== 'selamanya')
                                                    @if (Auth::check() && Auth::user()->role == 'administrator')
                                                        <button type="submit" class="btn btn-danger m-1"
                                                            onclick="return confirmDelete()">Delete</button>
                                                    @else
                                                        <button type="button" class="btn btn-danger m-1"
                                                            disabled>Delete</button>
                                                    @endif
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
