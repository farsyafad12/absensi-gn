@extends('layouts.main')

@section('container')
    @include('layouts.modal-kehadiran')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-2">Filter Data Siswa</h5>
            <p class="mb-4">Mencari Data Siswa Lebih Mudah Dengan Filter</p>
            <div class="container row">
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
                <div class="col-4 mt-3">
                    <label for="tanggal-kehadiran">Tanggal Absen :</label>
                    <input class="form-control" id="tanggal-kehadiran" type="date" name="tanggal-kehadiran"
                        onchange="filterData()" />
                        <button onclick="filterData()">kirim</button>
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
                                        <h6 class="fw-semibold mb-0">Jam Masuk</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Jam Keluar</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Status</h6>
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
                                            <p class="mb-0 fw-normal">-</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">-</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-primary rounded-3 fw-semibold">Hadir</span>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0">
                                            <button type="button" class="btn btn-warning m-1 editBtn"
                                                value="{{ $s->id_siswa }}">Ubah Status</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak Ada Data Siswa Yang Tersedia</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var todayDateInput = document.getElementById('tanggal-kehadiran');
            var today = new Date().toISOString().split('T')[0];
            var submitButton = $('#submitBtn');
            submitButton.prop({
                'disabled': true,
                'type': 'button'
            });
            todayDateInput.value = today;
            //var tanggalTerpilih = todayDateInput.value;
            //document.getElementById('tanggal').value = tanggalTerpilih;
        });
    </script>
    
    <!--<script>
        $(document).ready(function() {
            var submitButton = $('#submitBtn');

            $(document).on('click', '.editBtn', function() {
                var id_siswa = $(this).val();
                $('#modal-kehadiran').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/kehadiran/" + id_siswa,
                    success: function(response) {
                        $('#nama_siswa').val(response.student.nama_siswa);
                        $('#id_kelas').val(response.student.id_kelas);
                        $('#id_siswa').val(id_siswa);
                        submitButton.prop({
                            'disabled': false,
                            'type': 'submit'
                        });

                        if (response.kehadiran.length > 0) {
                            var firstKehadiran = response.kehadiran[0];
                            //console.log(firstKehadiran.id_kehadiran);
                            $('input[name="id_kehadiran"][value="' + firstKehadiran
                                .id_kehadiran + '"]').prop(
                                'checked', true);
                            $('#jam_masuk').val(firstKehadiran.jam_masuk);
                            $('#tanggal').val(firstKehadiran.tanggal);
                            $('#jam_keluar').val(firstKehadiran.jam_keluar);
                            $('#keterangan').val(firstKehadiran.keterangan);
                        } else {
                            console.log("No attendance records found for the student");
                        }
                    }
                });
            });

            $('#modal-kehadiran').on('hidden.bs.modal', function() {
                $('#nama_siswa').val('');
                $('#id_kelas').val('');
                $('#id_siswa').val('');
                $('input[name="id_kehadiran"]').prop('checked', false);
                $('#jam_masuk').val('');
                $('#jam_keluar').val('');
                $('#keterangan').val('');

                submitButton.prop({
                    'disabled': true,
                    'type': 'button'
                });
            });
        });
    </script>-->
    <script>
        function filterData() {
          var tanggal = $("#tanggal-kehadiran").val();
      
          // Kirim permintaan AJAX ke endpoint Laravel
          $.ajax({
            url: '/data-kehadiran/filter',
            type: 'GET',
            data: { tanggal: tanggal },
            success: function(response) {
              // Perbarui tabel dengan data yang diterima
              $('#tabelAbsensi').html(response);
              console.log(response.tanggal);
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
<script src="/assets/js/searchmenu.js"></script>
@endsection
