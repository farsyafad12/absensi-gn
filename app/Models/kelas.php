<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class kelas extends Model
{    
    protected $table = "tb_kelas";
    protected $primaryKey = "id_kelas";
    protected $fillable = [
        'wali_kelas', 'kelas', 'id_tingkat', 'id_kelas'
    ];

    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class, 'id_tingkat', 'id_tingkat');
    }

    public function siswa()
    {
        return $this->hasMany(data_siswa::class, 'id_kelas', 'id_kelas');
    }
}
