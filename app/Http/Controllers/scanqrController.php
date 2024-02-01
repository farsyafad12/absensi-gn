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
        $time = Carbon::now();
        $timenow = $time->format('Y-m-d H:i:s');
        $status = 'Masuk';
        $judul = 'Scan Masuk Qr Code Kehadiran';
        return view('scan-kehadiran/masuk', ['title' => $judul], ['status' => $status], compact('timenow'));
    }

    public function scan_keluar()
    {
        $time = Carbon::now();
        $status = 'Pulang';
        $timenow = $time->format('Y-m-d H:i:s');
        $judul = 'Scan Keluar Qr Code Kehadiran';
        return view('scan-kehadiran/keluar', ['title' => $judul], ['status' => $status], compact('timenow'));
    }

    public function checkSiswa(Request $request)
    {
        $nisn = $request->input('nisn');

        if (!$nisn) {
            return response()->json(['message' => 'NISN tidak ditemukan'], 404);
        }

        $siswa = data_siswa::where('nisn', $nisn)->first();

        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        $idSiswa = $siswa->id;
        $idKelas = $siswa->id_kelas;

        $currentDateTime = Carbon::now();
        $tanggal = $currentDateTime->format('Y-m-d');
        $jamMasuk = $currentDateTime->format('H:i');

        $kehadiran = absensi::where('id_siswa', $idSiswa)->where('tanggal', $tanggal)->first();

        if ($kehadiran) {
            $kehadiran->update([
                'id_kelas' => $idKelas,
                'id_kehadiran' => 1,
                'tanggal' => $tanggal,
                'jam_masuk' => $jamMasuk,
            ]);

            return response()->json(['message' => 'Kehadiran berhasil diupdate', 'nisn' => $nisn]);
        } else {
            absensi::create([
                'id_siswa' => $idSiswa,
                'id_kelas' => $idKelas,
                'id_kehadiran' => 1,
                'tanggal' => $tanggal,
                'jam_masuk' => $jamMasuk,
            ]);

            return response()->json(['message' => 'Kehadiran berhasil ditambahkan', 'nisn' => $nisn]);
        }
    }
}
