<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;
use App\Models\Penerima; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        // Periksa role pengguna
        if (Auth::user()->role !== 'admin' && Auth::user()->role !== 'petugas_lapangan') {
            abort(403, 'Unauthorized');
        }

        $laporans = Laporan::with('penerima')->get();

        // Ambil total penerima langsung dari tabel penerima
        $totalPenerima = Cache::remember('totalPenerima', 60, function () {
            return Penerima::count();
        });        

        // Statistik lainnya dari tabel laporan
        $totalSelesai = $laporans->where('status', 'selesai')->count();
        $totalBelumSelesai = $laporans->where('status', '!=', 'selesai')->count();

        // Data untuk grafik waktu penyelesaian per penerima
        $namaPenerima = $laporans->pluck('penerima.nama');
        $waktuPenyelesaian = $laporans->map(function ($laporan) {
            if ($laporan->tanggal_mulai && $laporan->tanggal_selesai) {
                return \Carbon\Carbon::parse($laporan->tanggal_mulai)
                    ->diffInDays(\Carbon\Carbon::parse($laporan->tanggal_selesai));
            }
            return 0;
        });

        // Data untuk grafik rata-rata waktu penyelesaian per desa
        $waktuDesa = Laporan::selectRaw('penerimas.desa, AVG(DATEDIFF(tanggal_selesai, tanggal_mulai)) as rata_rata')
            ->join('penerimas', 'laporans.id_penerima', '=', 'penerimas.id')
            ->whereNotNull('tanggal_mulai')
            ->whereNotNull('tanggal_selesai')
            ->groupBy('penerimas.desa')
            ->pluck('rata_rata', 'penerimas.desa');

        $namaDesa = $waktuDesa->keys();
        $rataRataDesa = $waktuDesa->values();

        // Data untuk grafik distribusi status berdasarkan desa
        $statusDesa = Laporan::select('penerimas.desa', 'laporans.status', DB::raw('count(*) as jumlah'))
            ->join('penerimas', 'laporans.id_penerima', '=', 'penerimas.id')
            ->groupBy('penerimas.desa', 'laporans.status')
            ->get()
            ->groupBy('desa');

        $grafikStatusDesa = [];

        foreach ($statusDesa as $desa => $data) {
            $grafikStatusDesa[$desa] = [
                'baru mulai' => 0,
                'progres' => 0,
                'selesai' => 0,
            ];

            foreach ($data as $entry) {
                $grafikStatusDesa[$desa][$entry->status] = $entry->jumlah;
            }
        }

        // Convert to JSON for Chart.js
        $grafikStatusDesaJSON = json_encode($grafikStatusDesa);

        return view('dashboard', compact(
            'totalPenerima',
            'totalSelesai',
            'totalBelumSelesai',
            'namaPenerima',
            'waktuPenyelesaian',
            'namaDesa',
            'rataRataDesa',
            'grafikStatusDesaJSON'
        ));
    }
}
