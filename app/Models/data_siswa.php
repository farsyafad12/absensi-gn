<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class data_siswa extends Model
{    
    protected $table = "tb_siswa";
    protected $primaryKey = "id_siswa";
    protected $fillable = [
        'nama_siswa', 'id_kelas', 'nisn', 'id_tingkat', 'jenis_kelamin'
    ];

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas', 'id_kelas');
    }

    public static function getEnumValues($attribute)
    {
        $instance = new static;

        $enum = DB::select("SHOW COLUMNS FROM {$instance->getTable()} WHERE Field = ?", [$attribute])[0]->Type;

        preg_match('/^enum\((.*)\)$/', $enum, $matches);
        
        return collect(explode(',', $matches[1]))->map(function($value) {
            return trim($value, "'");
        })->values()->all();
    }
}
