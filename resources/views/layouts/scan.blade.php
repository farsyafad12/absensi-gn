<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} | Halaman Absen Kehadiran | SIT Gema Nurani</title>
    @include('layouts.head')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center"
            style="background: hsl(218deg 50% 91%);">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0 mt-2 mb-2">
                            <div class="card-body p-3">
                                <div class="text-nowrap logo-img text-center d-block w-100 mb-3">
                                    <img src="/assets/images/logos/gema-large.png" width="180"
                                        alt="logo-gema-nurani">
                                </div>
                                @yield('container')
                                <div class="d-flex align-items-center justify-content-center">
                                    <h6 id="time" class="m-0 bg-primary py-2 px-4 rounded text-light mt-1">--.--
                                    </h6>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between px-4 py-2">
                                <div>
                                    <p><a class="text-primary fw-bold ms-2" href="https://wa.me/6288293898965"
                                            target="_blank">Hubungi Pengelola</a></p>
                                </div>
                                <div>
                                    <p><a class="text-primary fw-bold ms-2" href="{{ route('dashboard') }}">Kembali Ke
                                            Dashboard</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.file')
    <script type="text/javascript" src="/assets/js/zxing.js"></script>
    @yield('script')
    <script>
        function updateDateTime() {
            var now = new Date();
            var daysOfWeek = ['Ahad', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            var day = daysOfWeek[now.getDay()];
            var timeOptions = {
                hour12: false
            };
            var time = now.toLocaleTimeString(timeOptions);
            var date = now.toLocaleDateString();
            document.getElementById('time').innerText = date + ' ' + day + ', ' + time;
        }
        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>
