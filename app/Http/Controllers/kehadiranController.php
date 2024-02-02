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

    public function buat_kehadiran($id_siswa, Request $request)
    {
        $tanggal = $request->input('tanggal');

        $siswa = data_siswa::find($id_siswa);
        $kehadiran = Absensi::where('tanggal', $tanggal)
            ->where('id_siswa', $id_siswa)
            ->get();
        return response()->json([
            'status' => 200,
            'student' => $siswa,
            'kehadiran' => $kehadiran,
        ]);
    }

    public function kirim_kehadiran(Request $request)
    {
        $id_siswa = $request->input('id_siswa');
        $siswa = data_siswa::find($id_siswa);

        $validator = Validator::make($request->all(), [
            'id_kelas' => 'required',
            'id_siswa' => 'required',
            'id_kehadiran' => 'required',
            'tanggal' => 'required|date'
        ]);

        if ($validator->fails()) {
            Session::flash('message-failed', 'Maaf, Tolong Lengkapi Data Dengan Benar');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($siswa) {
            $tanggal = $request->input('tanggal');
            $kehadiran = absensi::where('id_siswa', $id_siswa)->where('tanggal', $tanggal)->first();

            if ($kehadiran) {
                // Tanggal sudah ada, lakukan update
                $kehadiranData = $request->all();
                $kehadiran->update($kehadiranData);

                return redirect()->route('data_kehadiran')->with('message', 'Berhasil Mengubah Status Kehadiran!');
            } else {
                // Tanggal belum ada, lakukan create
                $kehadiranData = $request->all();
                $kehadiran = Absensi::create($kehadiranData);

                return redirect()->route('data_kehadiran')->with('message', 'Berhasil Menambahkan Status Kehadiran!');
            }
        } else {
            return redirect()->route('data_kehadiran')->with('message', 'Siswa tidak ditemukan, Silahkan Coba Lagi !');
        }
    }


    public function filter_absensi(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $kelas = $request->input('kelas');
        // $absensi = absensi::where('id_kelas', $kelas)
        // ->whereDate('tanggal', $tanggal) 
        // ->get();
        $absensiData = Absensi::where('id_kelas', $kelas)
            ->whereDate('tanggal', $tanggal)
            ->get();
        $siswaData = data_siswa::where('id_kelas', $kelas)
            ->whereNotIn('id_siswa', function ($query) use ($kelas, $tanggal) {
                $query->select('id_siswa')
                    ->from('tb_absensi')
                    ->where('id_kelas', $kelas)
                    ->whereDate('tanggal', $tanggal);
            })
            ->get();

        return view('data-page/list-kehadiran', ['absensiData' => $absensiData, 'siswaData' => $siswaData], compact('tanggal'));
    }


    // public function kehadiran_filter(Request $request)
    // {
    //     $tanggal = $request->input('tanggal');

    //     // Query untuk mendapatkan data absensi sesuai tanggal
    //     $dataAbsensi = Absensi::whereDate('tanggal', $tanggal)->get();

    //     return view('data-page/data-kehadiran', ['dataAbsensi' => $dataAbsensi]);
    // }
}
