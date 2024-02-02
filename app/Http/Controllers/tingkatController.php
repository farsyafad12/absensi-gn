<?php

namespace App\Http\Controllers;

use App\Models\data_siswa;
use App\Models\kelas;
use Illuminate\Http\Request;
use App\Models\tingkat;
use App\Models\absensi;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class tingkatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit_tingkat($data_kelas)
    {
        $judul = 'Edit Tingkat';
        $tingkat = tingkat::find($data_kelas);
        return view('edit-page/edit-tingkat', ['title' => $judul], compact('tingkat'));
    }

    public function update_tingkat(Request $request, $data_tingkat)
    {
        // Validasi request data
        $validator = Validator::make($request->all(), [
            'nama_tingkat' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('message-failed', 'Maaf, Semua Kolom Harus Diisi !');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tingkat = tingkat::find($data_tingkat);
        $tingkat->update($request->all());

        return redirect()->route('data_tingkat')->with('message', 'Berhasil Update Data Kelas !');
    }

    public function tingkat_delete($data_tingkat)
    {
        $tingkat = tingkat::find($data_tingkat);

        if ($tingkat) {
            $kelas_to_delete = Kelas::where('id_tingkat', $data_tingkat)->get();

            foreach ($kelas_to_delete as $kelas) {
                $siswa_in_kelas = data_siswa::where('id_kelas', $kelas->id_kelas)->get();

                foreach ($siswa_in_kelas as $siswa) {
                    $related_absensi = absensi::where('id_siswa', $siswa->id_siswa)->get();

                    foreach ($related_absensi as $absensi) {
                        // Hapus data absensi terlebih dahulu
                        $absensi->delete();
                    }

                    // Hapus data siswa
                    $siswa->delete();
                }
            }

            // Hapus data kelas
            Kelas::where('id_tingkat', $data_tingkat)->delete();

            // Hapus data tingkat
            $tingkat->delete();

            return redirect()->route('data_tingkat')->with('message', 'Berhasil Menghapus Data Tingkat');
        } else {
            return redirect()->route('data_tingkat')->with('message-failed', 'Gagal Menghapus Kelas, Harap Coba Lagi');
        }
    }


    public function tambah_tingkat()
    {
        $judul = 'Tambah Tingkat';
        return view('tambah-page/tambah-tingkat', ['title' => $judul]);
    }

    public function buat_tingkat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('message-failed', 'Maaf, Semua Kolom Harus Diisi !');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tingkat = tingkat::create([
            'nama_tingkat' => $request->name
        ]);

        Session::flash('message', 'Berhasil Membuat Kelas Baru!');
        return redirect()->route('data_tingkat');
    }




    public function data_tingkat()
    {
        $judul = 'Daftar Tingkat';
        $tingkat = tingkat::select('*')
            ->get();
        return view('data-page/data-tingkat', ['tingkat' => $tingkat], ['title' => $judul]);
    }
}
