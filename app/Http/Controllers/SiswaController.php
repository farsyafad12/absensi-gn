<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\data_siswa;
use App\Models\kelas;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Date;
// use Illuminate\Http\Request;
// use App\Models\absensi;


class SiswaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function laporan()
    {
        $judul = 'Generate Laporan Kehadiran Siswa';
        $kelasList = Kelas::all();
        return view('other-page/laporan', ['title' => $judul], compact('kelasList'));
    }

    public function laporan_data($year, $month, $kelas)
    {
        $judul = 'Rekap Data Kehadiran Siswa';
        $siswa = data_siswa::where('id_kelas', $kelas)->get();
        $kelasInfo = kelas::find($kelas);
        $startDate = Carbon::createFromDate($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();
        $dates = [];
        $absensiData = [];

        while ($startDate->lte($endDate)) {
            $dates[] = [
                'date' => $startDate->format('d/m'),
                'day' => $startDate->format('l'),
            ];
            $absensi = DB::table('tb_absensi')
                ->whereDate('tanggal', $startDate->format('Y-m-d'))
                ->get();

            $absensiData[$startDate->format('d/m')] = $absensi;

            $startDate->addDay();
        }

        $bulan = $startDate->subMonth()->translatedFormat('F');
        $tahun = $startDate->format('Y');

        $getBackgroundColor = function ($idKehadiran) {
            switch ($idKehadiran) {
                case 1:
                    return 'green'; 
                case 2:
                    return 'yellow';
                case 3:
                    return 'orange';
                case 4:
                    return 'red'; 
                default:
                    return 'red'; 
            }
        };

        $getAttendanceText = function ($idKehadiran) {
            switch ($idKehadiran) {
                case 1:
                    return 'H';
                case 2:
                    return 'S';
                case 3:
                    return 'I';
                case 4:
                    return 'A';
                default:
                    return 'A';
            }
        };

        return view('other-page/rekap', [
            'title' => $judul,
            'bulan' => $bulan, 
            'tahun' => $tahun, 
            'getBackgroundColor' => $getBackgroundColor,
            'getAttendanceText' => $getAttendanceText,
        ], compact('dates', 'siswa', 'kelasInfo', 'absensiData'));
    }




    public function tampilkanDataAbsensi()
    {
        $today = $this->getTanggal(0);

        $left1 = $this->getTanggal(1);

        $left2 = $this->getTanggal(2);

        $left3 = $this->getTanggal(3);

        $left4 = $this->getTanggal(4);

        $left5 = $this->getTanggal(5);

        $left6 = $this->getTanggal(6);

        $left7 = $this->getTanggal(7);

        $dataToday = $this->getDataAbsensi($today);
        $dataLeft1 = $this->getDataAbsensi($left1);
        $dataLeft2 = $this->getDataAbsensi($left2);
        $dataLeft3 = $this->getDataAbsensi($left3);
        $dataLeft4 = $this->getDataAbsensi($left4);
        $dataLeft5 = $this->getDataAbsensi($left5);
        $dataLeft6 = $this->getDataAbsensi($left6);
        $dataLeft7 = $this->getDataAbsensi($left7);

        $countToday = count($dataToday);
        $countLeft1 = count($dataLeft1);
        $countLeft2 = count($dataLeft2);
        $countLeft3 = count($dataLeft3);
        $countLeft4 = count($dataLeft4);
        $countLeft5 = count($dataLeft5);
        $countLeft6 = count($dataLeft6);
        $countLeft7 = count($dataLeft7);
        $siswa = data_siswa::count();

        return response()->json([
            'siswa' => $siswa,
            'today' => $countToday,
            'left1' => $countLeft1,
            'left2' => $countLeft2,
            'left3' => $countLeft3,
            'left4' => $countLeft4,
            'left5' => $countLeft5,
            'left6' => $countLeft6,
            'left7' => $countLeft7,
        ]);
    }

    private function getTanggal($offset)
    {
        $today = now();
        $today->subDays($offset);
        return $today->toDateString();
    }

    private function getDataAbsensi($tanggal)
    {
        return DB::table('tb_absensi')->whereDate('tanggal', $tanggal)->get();
    }
}
