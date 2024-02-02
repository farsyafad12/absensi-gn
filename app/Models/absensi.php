<?php

namespace App\Models;

use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    protected $table = "tb_absensi";
    protected $primaryKey = "id_absensi";
    public $timestamps = false;
    protected $fillable = [
        'id_kehadiran', 'id_siswa', 'id_kelas', 'tanggal', 'jam_masuk', 'jam_keluar', 'keterangan'
    ];
    protected $attributes = [
        'jam_masuk' => null,
        'jam_keluar' => null,
        'keterangan' => null,
        'id_kehadiran' => null
    ];

    public function siswa()
    {
        return $this->belongsTo(data_siswa::class, 'id_siswa', 'id_siswa');
    }

    public function kehadiran()
    {
        return $this->belongsTo(kehadiran::class, 'id_kehadiran', 'id_kehadiran');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas', 'id_kelas');
    }
}
