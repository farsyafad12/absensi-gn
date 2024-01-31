<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user_setting()
    {
        $judul = 'Pengaturan Semua Akun Admin';
        $user = User::select('*')
            ->get();
        return view('setting', ['user' => $user], ['title' => $judul]);
    }


    public function tambah_pengelola()
    {
        $judul = 'Tambah Pengelola';
        $role = User::getEnumValues('role');
        return view('tambah-page/tambah-pengelola', ['title' => $judul], compact('role'));
    }


    public function delete($id)
    {
        $user = User::find($id);
        if ($user->status == 'selamanya') {
            return redirect()->back()->with('error', 'Maaf, Pengguna Ini Tidak Dapat Dihapus');
        } else {
            if ($user) {
                $user->delete();
                return redirect()->route('user_detail')->with('message', 'Berhasil Menghapus Pengguna');
            } else {
                return redirect()->route('user_detail')->with('message-failed', 'Gagal Menghapus Pengguna, Harap Coba Lagi');
            }
        }
    }


    public function create_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required',
            'username' => 'required',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('message-failed', 'Gagal, Mohon Isi Data Dibawah Dengan Benar !');
            return redirect()->back()->withInput();
        }

        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'biasa'
        ]);

        return redirect()->route('user_detail')->with('message', 'Akun Pengelola Baru Berhasil Dibuat !');
    }


    public function edit($id)
    {
        $title = 'Edit Akun Pengelola';
        $user = User::find($id);
        $role = User::getEnumValues('role');

        return view('edit-page/edit-pengelola', compact('title', 'user', 'role'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('message-failed', 'Gagal, Semua Data Wajib Di Isi');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('data_kelas')->with('message-failed', 'Data Siswa Tidak Ditemukan');
        }

        if ($request->filled('password')) {
            $request->merge(['password' => Hash::make($request->password)]);
        } else {
            $request->request->remove('password');
        }

        $user->update($request->all());

        return redirect()->route('user_detail')->with('message', 'Berhasil Update Akun Pengguna!');
    }
}
