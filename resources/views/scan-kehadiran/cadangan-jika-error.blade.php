<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} | Halaman Kehadiran | SIT Gema Nurani</title>
    @include('layouts.head')
</head>

<body>

    <main class="wrapper" style="padding-top:2em">

        <section class="container" id="demo-content">
            <h1 class="title">Scan QR Code from Video Camera</h1>
            <div>
                <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
            </div>

            <div id="sourceSelectPanel" style="display:none">
                <label for="sourceSelect">Change video source:</label>
                <select id="sourceSelect" style="max-width:400px">
                </select>
            </div>

            <label>Result:</label>
            <ul>
                <li id="nama">--</li>
                <li id="kelas">--</li>
                {{-- <li id="idsiswa">--</li> --}}
                <li id="jammasuk">--</li>
                <li id="tanggal">--</li>
                <li id="pesan">--</li>
            </ul>


        </section>
    </main>

    <script type="text/javascript" src="/assets/js/zxing.js"></script>
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

                    console.log(`Melanjutkan Scanner QR Code Pada Kamera Yang Memiliki ID : ${selectedDeviceId}`);
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
                    if (response.tanggal) {
                        // console.log(response.tanggal)
                        document.getElementById('tanggal').innerText = response.tanggal;
                    }
                    if (response.pesan) {
                        // console.log(response.pesan)
                        document.getElementById('pesan').innerText = response.pesan;
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

</body>

</html>
