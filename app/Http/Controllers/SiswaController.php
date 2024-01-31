<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class SiswaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function laporan()
    {
        $judul = 'Generate Laporan Kehadiran Siswa';
        return view('other-page/laporan', ['title' => $judul]);
    }

    public function laporan_data($year, $month)
    {
        $judul = 'Rekap Data Kehadiran Siswa';
        $startDate = Carbon::createFromDate($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();
        $dates = [];

        while ($startDate->lte($endDate)) {
            $dates[] = [
                'date' => $startDate->format('d/m'),
                'day' => $startDate->format('l'), // Format 'l' menampilkan nama hari
            ];
            $startDate->addDay();
        }
        return view('other-page/rekap', ['title' => $judul], compact('dates'));
    }
}
