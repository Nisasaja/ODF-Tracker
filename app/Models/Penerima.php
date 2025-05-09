<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    protected $fillable = [
    'nama', 
    'desa', 
    'kondisi_jamban', 
    'kendala', 
    'jml_penghuni', 
    'pekerjaan', 
    'sumber_air', 
    'no_telepon'];

    public function laporans()
    {
        return $this->hasMany(Laporan::class, 'id_penerima');
    }
}

