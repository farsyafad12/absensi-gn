@extends('layouts.scan')

@section('container')
    <div class="container text-center d-flex align-items-center flex-column mb-2">
        <div class="btn-group mb-3">
            <a href="{{ route('scan_masuk') }}"
                class="btn btn-primary {{ request()->url() == route('scan_masuk') ? ' active' : '' }}"
                aria-current="page">Scan Masuk</a>
            <a href="{{ route('scan_keluar') }}"
                class="btn btn-primary {{ request()->url() == route('scan_keluar') ? ' active' : '' }}"
                aria-current="page">Scan Pulang</a>
        </div>
        @include('layouts.alert-kehadiran')
        <div>
            <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
        </div>
        <div id="sourceSelectPanel" class="mb-2 d-flex align-items-center gap-3 mt-2 w-100 justify-content-center"
            style="display: none;">
            <label for="sourceSelect">Ubah Sumber Kamera : </label>
            <select class="form-select" id="sourceSelect" style="max-width: 200px;"
                title="Detail Spesifikasi Kamera Yang Sedang Digunakan">
            </select>
        </div>

        <div class="row text-center d-flex justify-content-between w-100 mb-1">
            <div class="col-6">Nama Siswa : <span id="nama">--</span></div>
            <div class="col-6">Kelas : <span id="kelas">--</span></div>
        </div>
        <div class="row text-center d-flex justify-content-between w-100">
            <div class="col-6">Jam Masuk : <span id="jammasuk">--</span></div>
            <div class="col-6">Jam Pulang : <span id="jampulang">--</span></div>
        </div>
        <div class="row text-center d-flex justify-content-between w-100">
            {{-- <h6 class="col-12">Pesan : <span id="pesan">--</span></h6> --}}
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        window.addEventListener('load', function() {
            let selectedDeviceId;
            const codeReader = new ZXing.BrowserMultiFormatReader();
            console.log('Mengakfitkan QR Code .....');

            codeReader.listVideoInputDevices()
                .then((videoInputDevices) => {
                    const sourceSelect = document.getElementById('sourceSelect');
                    selectedDeviceId = videoInputDevices[0].deviceId;

                    if (videoInputDevices.length >= 1) {
                        videoInputDevices.forEach((element) => {
                            const sourceOption = document.createElement('option');
                            sourceOption.text = element.label;
                            sourceOption.value = element.deviceId;
                            sourceSelect.appendChild(sourceOption);
                        });

                        sourceSelect.onchange = () => {
                            selectedDeviceId = sourceSelect.value;
                        };

                        const sourceSelectPanel = document.getElementById('sourceSelectPanel');
                        sourceSelectPanel.style.display = 'block';
                    }

                    codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                        if (result) {
                            console.log("Isi QR Code : " + result);
                            checkDataInDatabase(result.text);
                            playNotificationSound('success');
                        }

                        if (err && !(err instanceof ZXing.NotFoundException)) {
                            console.error(err);
                            document.getElementById('pesan').textContent = err;
                            playNotificationSound('failed');
                        }
                    });

                    console.log(
                        `Melanjutkan Scanner QR Code Pada Kamera Yang Memiliki ID : ${selectedDeviceId}`);
                })
                .catch((err) => {
                    console.error(err);
                });

        });

        function playNotificationSound(type) {
            const audio = new Audio(`/assets/sound/notification-${type}.mp3`);
            audio.play();
        }

        function checkDataInDatabase(qrData) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/cek-qr/masuk',
                type: 'POST',
                data: {
                    qrData: qrData
                },
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                success: function(response) {
                    console.log(response.message);
                    // if (response.siswa) {
                    //     console.log(response.siswa)
                    // }
                    if (response.masuk) {
                        // console.log(response.masuk)
                        document.getElementById('jammasuk').innerText = response.masuk;
                    }
                    if (response.pulang) {
                        // console.log(response.masuk)
                        document.getElementById('jampulang').innerText = response.pulang;
                    }
                    if (response.pesan) {
                        // console.log(response.pesan)
                        var pesan = document.getElementById('pesan');
                        if (pesan.style.display === 'none') {
                            pesan.style.display = 'block';
                        }
                        pesan.innerText = response.pesan;
                    }
                    document.getElementById('nama').innerText = response.siswa.nama_siswa;
                    document.getElementById('kelas').innerText = response.kelas;
                    // document.getElementById('idsiswa').innerText = response.siswa.id_siswa;
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    </script>
@endsection
