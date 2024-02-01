<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\data_siswa;
use App\Models\absensi;
use App\Models\kelas;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    //register area
    public function register()
    {
        $judul = 'Daftar Akun';
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('auth/register', ['title' => $judul]);
    }

    public function actionregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d).+$/',
            ],
            'email' => 'required',
            'username' => 'required'
        ]);

        if ($validator->fails()) {
            Session::flash('message-failed', 'Mohon Buat Password Minimal 8 Huruf, 1 Angka, Dan Huruf Besar!');
            return redirect()->back()->withInput();
        }


        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif, silahkan login menggunakan username dan password.');
        Auth::logout();
        return redirect('login');
    }



    // Login Area
    public function login()
    {
        $judul = 'Login Akun';
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('auth/login', ['title' => $judul]);
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($data)) {
            return redirect('/');
            Session::flash('message', 'Berhasil Login');
        } else {
            Session::flash('message-failed', 'Maaf, Email atau Password Salah');
            return redirect('/login');
        }
    }


    public function actionlogout()
    {
        Auth::logout();
        return redirect('/login');
    }

    //Dasboard Area
    public function index()
    {
        $judul = 'Dashboard Absensi Siswa';
        $siswa = data_siswa::count();
        $kelas = kelas::count();
        $user = User::count();
        $absensi = absensi::orderBy('tanggal', 'desc')->get();
        $today = Carbon::now()->toDateString();

        $statusHadir = Absensi::where('id_kehadiran', 1)
            ->whereDate('tanggal', $today)
            ->count();
        $statusSakit = Absensi::where('id_kehadiran', 2)
            ->whereDate('tanggal', $today)
            ->count();
        $statusIzin = Absensi::where('id_kehadiran', 3)
            ->whereDate('tanggal', $today)
            ->count();

        $siswaAlpha = DB::table('tb_siswa')
            ->leftJoin('tb_absensi', function ($join) use ($today) {
                $join->on('tb_siswa.id_siswa', '=', 'tb_absensi.id_siswa')
                    ->whereDate('tb_absensi.tanggal', '=', $today);
            })
            ->whereNull('tb_absensi.id_siswa')
            ->pluck('tb_siswa.id_siswa')
            ->toArray();

        $statusAlpha = count($siswaAlpha);

        return view('dashboard', [
            'title' => $judul,
            'siswa' => $siswa,
            'kelas' => $kelas,
            'user' => $user,
            'absensi' => $absensi,
            'statusHadir' => $statusHadir,
            'statusSakit' => $statusSakit,
            'statusIzin' => $statusIzin,
            'statusAlpha' => $statusAlpha,
        ]);
    }
}
