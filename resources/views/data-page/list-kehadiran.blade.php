<!DOCTYPE html>
<html>

<head>
    <title>Hasil Filter</title>
</head>

<body>
    <p>Tanggal Terpilih : {{ $tanggal }}</p>
    <table class="table text-nowrap mb-0 align-middle">
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
                    <h6 class="fw-semibold mb-0">Keterangan</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Aksi</h6>
                </th>
            </tr>
        </thead>
        <tbody>
            @if ((isset($absensiData) && !$absensiData->isEmpty()) || (isset($siswaData) && !$siswaData->isEmpty()))
                @if (isset($absensiData) && !$absensiData->isEmpty())
                    @foreach ($absensiData as $item)
                        <tr>
                            <td class="border-bottom-0">
                                <h6>{{ $loop->iteration }}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">{{ $item->siswa->nama_siswa }}</h6>
                                <span class="fw-normal">{{ $item->kelas->tingkat->nama_tingkat }}</span>
                            </td>
                            <td class="border-bottom-0">
                                <h6>{{ $item->kelas->kelas }}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6>{{ $item->jam_masuk }}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6>{{ $item->jam_keluar }}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <span
                                        class="badge bg-primary rounded-3 fw-semibold">{{ $item->kehadiran->kehadiran }}</span>
                                </div>
                            </td>
                            <td class="border-bottom-0">
                                <h6>{{ Illuminate\Support\Str::limit($item->keterangan, 15) }}</h6>
                            </td>
                            <td class="border-bottom-0">
                                @if (Auth::check() && Auth::user()->role == 'administrator')
                                    <button type="button" class="btn btn-warning m-1 editBtn"
                                        value="{{ $item->id_siswa }}">Ubah Status</button>
                                @else
                                    <button type="button" class="btn btn-warning m-1 editBtn" disabled>Ubah
                                        Status</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    {{-- @elseif(isset($absensiData) && $absensiData->isEmpty())
                <td colspan="8" class="text-center text-danger">Silahkan Pilih Filter Di Atas Terlebih Dahulu</td> --}}
                @endif
                @if (isset($siswaData) && !$siswaData->isEmpty())
                    @foreach ($siswaData as $item)
                        <tr>
                            <td class="border-bottom-0">
                                <h6>{{ $loop->iteration }}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1">{{ $item->nama_siswa }}</h6>
                                <span class="fw-normal">{{ $item->kelas->tingkat->nama_tingkat }}</span>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 ">{{ $item->kelas->kelas }}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal text-danger">--</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal text-danger">--</h6>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-danger rounded-3 fw-semibold">Alpha</span>
                                </div>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal text-danger">--</h6>
                            </td>
                            <td class="border-bottom-0">
                                @if (Auth::check() && Auth::user()->role == 'administrator')
                                    <button type="button" class="btn btn-warning m-1 editBtn"
                                        value="{{ $item->id_siswa }}">Ubah Status</button>
                                @else
                                    <button type="button" class="btn btn-warning m-1 editBtn" disabled>Ubah
                                        Status</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            @else
                <tr>
                    <td colspan="8" class="text-center text-danger">Silahkan Pilih Filter Di Atas Terlebih Dahulu
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            var submitButton = $('#submitBtn');

            $('#tanggal-kehadiran').on('change', function() {
                updateTanggalValue();
            });

            function updateTanggalValue() {
                var tanggal = document.getElementById('tanggal-kehadiran').value;
                $('#tanggal').val(tanggal);
            }

            $(document).on('click', '.editBtn', function() {
                var id_siswa = $(this).val();
                var tanggal = $('#tanggal-kehadiran').val();
                $('#modal-kehadiran').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/kehadiran/" + id_siswa,
                    data: {
                        tanggal: tanggal,
                    },
                    success: function(response) {
                        // $('#nama_siswa').val(response.student.nama_siswa);
                        $('#id_kelas').val(response.student.id_kelas);
                        $('#id_siswa').val(id_siswa);
                        $('#tanggal').val(tanggal);

                        if (response.kehadiran.length > 0) {
                            var firstKehadiran = response.kehadiran[0];
                            $('input[name="id_kehadiran"][value="' + firstKehadiran
                                .id_kehadiran + '"]').prop('checked', true);
                            $('#jam_masuk').val(firstKehadiran.jam_masuk);
                            updateTanggalValue
                                ();
                            $('#jam_keluar').val(firstKehadiran.jam_keluar);
                            $('#keterangan').val(firstKehadiran.keterangan);
                        } else {
                            console.log("Belum Ada Riwayat Kehadiran Dari Siswa Ini");
                        }
                        submitButton.prop({
                            'disabled': false,
                            'type': 'submit'
                        });
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

                updateTanggalValue();
            });
        });
    </script>

</body>

</html>
