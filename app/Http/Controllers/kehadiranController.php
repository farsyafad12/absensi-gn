<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use Illuminate\Http\Request;
use App\Models\data_siswa;
use App\Models\kelas;
use App\Models\tingkat;
use App\Models\kehadiran;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class kehadiranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function data_kehadiran()
    {
        $judul = 'Database Kehadiran';
        $siswa = data_siswa::select('*')
            ->get();
        $siswaList = data_siswa::all();
        $kelasList = Kelas::all();
        $tingkat = tingkat::all();
        $kehadiran = kehadiran::all();
        $absensi = absensi::all();
        return view('data-page/data-kehadiran', ['title' => $judul], compact('siswa', 'kelasList', 'siswaList', 'tingkat', 'kehadiran', 'absensi'));
    }

    public function buat_kehadiran($id_siswa)
    {
        $siswa = data_siswa::find($id_siswa);
        $kehadiran = absensi::where('id_siswa', $id_siswa)->get();
        return response()->json([
            'status' => 200,
            'student' => $siswa,
            'kehadiran' => $kehadiran,
        ]);
    }

    public function kirim_kehadiran(Request $request)
    {
        $id_siswa = $request->input('id_siswa');
        $kehadiran = absensi::where('id_siswa', $id_siswa)->first();
        $siswa = data_siswa::find($id_siswa);

        $validator = Validator::make($request->all(), [
            'id_kelas' => 'required',
            'nama_siswa' => 'required',
            'id_kehadiran' => 'required',
            'tanggal' => 'tanggal'
        ]);

        if ($validator->fails()) {
            Session::flash('message-failed', 'Maaf, Tolong Lengkapi Data Dengan Benar');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($siswa) {
            if ($kehadiran) {
                $kehadiranData = $request->all();
                $kehadiran->update($kehadiranData);

                return redirect()->route('data_kehadiran')->with('message', 'Berhasil Mengubah Status Kehadiran!');
            } else {
                $kehadiranData = $request->all();
                $kehadiran = Absensi::create($kehadiranData);

                return redirect()->route('data_kehadiran')->with('message', 'Berhasil Menambahkan Status Kehadiran!');
            }
        } else {
            return redirect()->route('data_kehadiran')->with('message', 'Siswa tidak ditemukan!');
        }
    }

    public function kehadiran_filter(Request $request)
    {
        $tanggal = $request->input('tanggal');
    
        // Query untuk mendapatkan data absensi sesuai tanggal
        $dataAbsensi = Absensi::whereDate('tanggal', $tanggal)->get();
    
        return view('data-page/data-kehadiran', ['dataAbsensi' => $dataAbsensi]);
    }
}
