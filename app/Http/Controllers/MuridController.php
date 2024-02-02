<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_siswa;
use App\Models\kelas;
use App\Models\tingkat;
use App\Models\absensi;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class MuridController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function data_siswa()
    {
        $judul = 'Database Siswa';
        $siswa = data_siswa::select('*')
            ->get();
        $kelasList = Kelas::all();
        $tingkat = tingkat::all();
        return view('data-page/data-siswa', ['title' => $judul], compact('siswa', 'kelasList', 'tingkat'));
    }

    public function edit_siswa($data_siswa)
    {
        $judul = 'Edit Siswa';
        $siswa = data_siswa::find($data_siswa);
        $kelasList = Kelas::all();
        $jenis_kelamin = data_siswa::getEnumValues('jenis_kelamin');
        return view('edit-page/edit-siswa', ['title' => $judul], compact('jenis_kelamin', 'siswa', 'kelasList'));
    }

    public function update(Request $request, $data_siswa)
    {
            $validator = Validator::make($request->all(), [
                'nisn' => 'required',
                'name' => 'required',
                'jenis_kelamin' => 'required',
                'kelas' => 'required'
            ]);

            if ($validator->fails()) {
                Session::flash('message-failed', 'Gagal, Semua Data Wajib Di Isi');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $siswa = data_siswa::find($data_siswa);

            if (!$siswa) {
                return redirect()->route('data_siswa')->with('message', 'Data Siswa Tidak Ditemukan');
            }

            $siswa->update([
                'nama_siswa' => $request->name,
                'nisn' => $request->nisn,
                'id_kelas' => $request->kelas,
                'jenis_kelamin' => $request->jenis_kelamin 
            ]);

            return redirect()->route('data_siswa')->with('message', 'Berhasil Update Detail Siswa !');
        } 




    public function tambah_siswa()
    {
        $judul = 'Tambah Siswa';
        $jenis_kelamin = data_siswa::getEnumValues('jenis_kelamin');
        $kelasList = Kelas::all();
        return view('tambah-page/tambah-siswa', ['title' => $judul], compact('jenis_kelamin', 'kelasList'));
    }
    public function buat_siswa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nisn' => 'required',
            'name' => 'required',
            'jenis_kelamin' => 'required',
            'kelas' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('message-failed', 'Gagal, Semua Data Wajib Di Isi');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $siswa = data_siswa::create([
            'nama_siswa' => $request->name,
            'nisn' => $request->nisn,
            'id_kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);
        return redirect()->route('data_siswa')->with('message', 'Berhasil Menambahkan Siswa Baru');
    }

    public function siswa_delete($data_siswa)
    {
        $siswa = data_siswa::find($data_siswa);

        if ($siswa) {
            absensi::where('id_siswa', $siswa->id_siswa)->delete();
            $siswa->delete();
            return redirect()->route('data_siswa')->with('message', 'Berhasil Menghapus Siswa');
        } else {
            return redirect()->route('data_siswa')->with('message-failed', 'Gagal Menghapus Siswa, Harap Coba Lagi');
        }
    }
}
