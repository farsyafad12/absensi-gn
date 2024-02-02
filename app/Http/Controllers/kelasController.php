<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kelas;
use App\Models\data_siswa;
use App\Models\tingkat;
use App\Models\absensi;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class kelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function data_kelas()
    {
        $judul = 'Daftar Kelas';
        $kelas = kelas::select('*')->get();
        $tingkat = tingkat::all();
        return view('data-page/data-kelas', ['title' => $judul], compact('kelas', 'tingkat'));
    }

    public function edit_kelas($data_kelas)
    {
        $judul = 'Edit Kelas';
        $kelas = kelas::find($data_kelas);
        $tingkat = tingkat::all();
        return view('edit-page/edit-kelas', ['title' => $judul], compact('kelas', 'tingkat'));
    }


    public function update_kelas(Request $request, $data_kelas)
    {
        $validator = Validator::make($request->all(), [
            'wali' => 'required',
            'kelas' => 'required',
            'tingkat' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('message-failed', 'Gagal, Semua Data Wajib Di Isi');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kelas = kelas::find($data_kelas);
        if (!$kelas) {
            return redirect()->route('data_kelas')->with('message-failed', 'Data Kelas Tidak Ditemukan');
        }

        $kelas->update([
            'wali_kelas' => $request->wali,
            'kelas' => $request->kelas,
            'tingkat' => $request->id_tingkat,
        ]);

        return redirect()->route('data_kelas')->with('message', 'Berhasil Update Detail Kelas !');
    }

    public function kelas_delete($data_kelas)
    {
        $kelas = kelas::find($data_kelas);

        if ($kelas) {
            try {
                // Delete related records in tb_siswa
                data_siswa::where('id_kelas', $kelas->id)->delete();

                // Delete related records in tb_absensi
                absensi::where('id_kelas', $kelas->id)->delete();

                // Delete the $kelas instance
                $kelas->delete();

                return redirect()->route('data_kelas')->with('message', 'Berhasil Menghapus Kelas');
            } catch (\Exception $e) {
                // Handle any exceptions that may occur during deletion
                return redirect()->route('data_kelas')->with('message-failed', 'Gagal Menghapus Kelas: ' . $e->getMessage());
            }
        } else {
            return redirect()->route('data_kelas')->with('message-failed', 'Gagal Menghapus Kelas, Harap Coba Lagi');
        }
    }


    public function tambah_kelas()
    {
        $judul = 'Tambah Kelas';
        $tingkat = tingkat::all();
        return view('tambah-page/tambah-kelas', ['title' => $judul], compact('tingkat'));
    }
    public function buat_kelas(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wali' => 'required',
            'kelas' => 'required',
            'tingkat' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('message-failed', 'Maaf, Semua Kolom Harus Diisi !');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kelas = kelas::create([
            'wali_kelas' => $request->wali,
            'kelas' => $request->kelas,
            'id_tingkat' => $request->tingkat
        ]);
        return redirect()->route('data_kelas')->with('message', 'Berhasil Membuat Kelas Baru');
    }
}
