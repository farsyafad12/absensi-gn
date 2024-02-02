@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <i class="ti ti-school"></i>
                    Student
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $siswa }} Siswa</h5>
                    <p class="card-text">Jumlah Semua Siswa</p>
                    <a href="data-siswa" class="btn btn-secondary">Lihat Semua Siswa</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <i class="ti ti-building"></i>
                    Class
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $kelas }} Kelas</h5>
                    <p class="card-text">Jumlah Semua Kelas</p>
                    <a href="data-kelas" class="btn btn-secondary">Lihat Semua Kelas</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <i class="ti ti-user"></i>
                    Petugas
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $user }} Petugas</h5>
                    <p class="card-text">Jumlah Semua Petugas</p>
                    <a href="setting" class="btn btn-secondary">Lihat Semua Petugas</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!--<h5 class="card-title fw-semibold mb-4">Titles, text, and links</h5>-->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Absensi Siswa Hari Ini</h4>
                    <h5 class="card-subtitle mb-2 text-muted" id="time"></h5>
                    <div class="container text-center">
                        <div class="row align-items-center mt-4 mb-4 p-2">
                            <div class="col">
                                <h5>Hadir</h5>
                                <h4>{{ $statusHadir }} Siswa</h4>
                            </div>
                            <div class="col">
                                <h5>Izin</h5>
                                <h4>{{ $statusIzin }} Siswa</h4>
                            </div>
                            <div class="col">
                                <h5>Sakit</h5>
                                <h4>{{ $statusSakit }} Siswa</h4>
                            </div>
                            <div class="col">
                                <h5>Alpha</h5>
                                <h4>{{ $statusAlpha }} Siswa</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Statistik Aktivitas Kehadiran</h5>
                        </div>
                        <div>
                            <p>Statistik Aktivitas Kehadiran Siswa Dalam 7 Hari Terakhir</p>
                        </div>
                    </div>
                    <div id="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">Riwayat Absensi Terakhir</h5>
                    </div>
                    <ul class="timeline-widget mb-0 position-relative mb-n5">
                    @forelse ($absensi->take(5) as $a)
                    <li class="timeline-item d-flex position-relative overflow-hidden">
                        <div class="timeline-time text-dark flex-shrink-0 text-end">{{ $a->tanggal }}</div>
                        <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                            <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>                         
                        </div>
                        <div class="timeline-desc fs-3 text-dark mt-n1">{{ $a->siswa->nama_siswa }}</div>
                    </li>
                    @empty
                        <li class="text-center text-danger user-select-none">Tidak Ada Riwayat Terbaru</li>
                    @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inlinefile')
    <script src="/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/assets/js/dashboard.js"></script>
    <script>
        function updateDate() {
            var now = new Date();
            var options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            var date = now.toLocaleDateString('id-ID', options);
            document.getElementById('time').innerText = date;
        }
        updateDate();
    </script>
@endsection
