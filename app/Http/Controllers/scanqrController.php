<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\data_siswa;

class scanqrController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function scan()
    {
        return redirect()->route('scan_masuk');
    }

    public function scan_masuk()
    {
        $status = 'Masuk';
        $judul = 'Scan Masuk Qr Code Kehadiran';
        return view('scan-kehadiran/masuk', ['title' => $judul], ['status' => $status]);
    }

    public function masuk_cek(Request $request)
    {
        $nisn = $request->input('qrData');
        $siswa = data_siswa::where('nisn', $nisn)->first();
        $kelas = $siswa->kelas->kelas;
        $currentDateTime = Carbon::now();
        $tanggal = $currentDateTime->format('Y-m-d');
        $jamMasuk = $currentDateTime->format('H:i');

        if ($siswa) {
            $absensi = absensi::where('id_siswa', $siswa->id_siswa)
                ->where('tanggal', $tanggal)
                ->first();
            if ($absensi) {
                if ($absensi->jam_masuk !== null) {
                    $message = "Anda Telah Melakukan Absen Sebelumnya";
                    $jamsiswa = $absensi->jam_masuk;
                    $jamPulang = $absensi->jam_keluar;
                } else {
                    $absensi->id_kehadiran = 1;
                    $absensi->jam_masuk = $jamMasuk;
                    $absensi->save();
                    $message = "Berhasil Update Data Kehadiran!";
                    $jamsiswa = $absensi->jam_masuk;
                    $jamPulang = $absensi->jam_keluar;
                }
            } else {
                $absensi = new absensi();
                $absensi->id_siswa = $siswa->id_siswa;
                $absensi->id_kelas = $siswa->id_kelas;
                $absensi->id_kehadiran = 1;
                $absensi->tanggal = $tanggal;
                $absensi->jam_masuk = $jamMasuk;
                $absensi->save();
                $message = "Berhasi Tambah Kehadiran !";
                $jamsiswa = $absensi->jam_masuk;
                $jamPulang = $absensi->jam_keluar;
            }

            return response()->json(['message' => 'Data QR Code ditemukan', 'siswa' => $siswa, 'masuk' => $jamsiswa, 'pulang' => $jamPulang, 'kelas' => $kelas, 'pesan' => $message]);
        } else {
            $message = "Maaf, Data Siswa / Data QR Code Tidak Ditemukan / Format QR Code Salah !";
            return response()->json(['message' => 'Gagal Membaca QR Code', 'pesan' => $message]);
        }
    }

    public function pulang_cek(Request $request)
    {
        $nisn = $request->input('qrData');
        $siswa = data_siswa::where('nisn', $nisn)->first();
        $kelas = $siswa->kelas->kelas;
        $currentDateTime = Carbon::now();
        $tanggal = $currentDateTime->format('Y-m-d');
        $jamPulang = $currentDateTime->format('H:i');

        if ($siswa) {
            $absensi = absensi::where('id_siswa', $siswa->id_siswa)
                ->where('tanggal', $tanggal)
                ->first();
            if ($absensi) {
                if ($absensi->jam_masuk == null) {
                    $message = "Anda Belum Melakukan Absen Masuk";
                    $jamsiswa = "--";
                    $jamMasuk = "--";
                } else {
                    if ($absensi->jam_keluar == null) {
                        $absensi->id_kehadiran = 1;
                        $absensi->jam_keluar = $jamPulang;
                        $absensi->save();
                        $message = "Berhasil Update Data Kehadiran!";
                        $jamMasuk = $absensi->jam_masuk;
                        $jamsiswa = $absensi->jam_keluar;
                    } else {
                        $jamMasuk = $absensi->jam_masuk;
                        $jamsiswa = $absensi->jam_keluar;
                        $message = "Anda Sudah Melakukan Absen Pulang Sebelumnya";
                    }
                }
            } else {
                $jamMasuk = "--";
                $jamsiswa = "--";
                $message = "Silahkan Absen Masuk Terlebih Dahulu";
            }

            return response()->json(['message' => 'Data QR Code ditemukan', 'siswa' => $siswa, 'masuk' => $jamMasuk, 'pulang' => $jamsiswa, 'kelas' => $kelas, 'pesan' => $message]);
        } else {
            $message = "Maaf, Data Siswa / Data QR Code Tidak Ditemukan / Format QR Code Salah !";
            return response()->json(['message' => 'Gagal Membaca QR Code', 'pesan' => $message]);
        }
    }


    public function scan_keluar()
    {
        $time = Carbon::now();
        $status = 'Pulang';
        $timenow = $time->format('Y-m-d H:i:s');
        $judul = 'Scan Keluar Qr Code Kehadiran';
        return view('scan-kehadiran/keluar', ['title' => $judul], ['status' => $status], compact('timenow'));
    }
}
