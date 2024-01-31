<?php

namespace App\Http\Controllers;

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

    public function check_siswa($nisn)
    {
        $siswa = data_siswa::where('nisn', $nisn)->first();

        if (!$siswa) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        }

        return response()->json($siswa);
    }
}
