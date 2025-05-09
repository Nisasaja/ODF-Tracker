<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_penerima',
        'judul_laporan',
        'isi_laporan',
        'foto',
        'status',
        'tgl_laporan',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function penerima()
    {
        return $this->belongsTo(Penerima::class, 'id_penerima');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
