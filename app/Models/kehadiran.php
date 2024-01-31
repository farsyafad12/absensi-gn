<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kehadiran extends Model
{    
    protected $table = "tb_kehadiran";
    protected $primaryKey = "id_kehadiran";
    protected $fillable = [
        'kehadiran', 'id_kehadiran'
    ];
}
