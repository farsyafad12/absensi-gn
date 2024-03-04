<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Tidak Ditemukan Atau Tidak Tersedia | SIT Gema Nurani</title>
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
                                @yield('container')
                            </div>
                            @yield('footer')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.file')
    @yield('inlinefile')
</body>

</html>
