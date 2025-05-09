<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;
use App\Models\Penerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,petugas_lapangan')->except(['index', 'create', 'edit', 'download']);
    }
    
    public function penerima()
    {
        return $this->belongsTo(Penerima::class, 'id_penerima');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->get('perPage', 5);

        // Query to filter based on search
        $laporans = Laporan::with('user','penerima')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('judul_laporan', 'like', "%{$search}%")
                    ->orWhere('isi_laporan', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('penerima', function ($query) use ($search) {
                        $query->where('nama', 'like', "%{$search}%");
                    });
                });
            })
            ->paginate($perPage);

        return view('laporans.index', compact('laporans', 'search'));
    }


    public function create()
    {
        $penerimas = Penerima::all(); 
        return view('laporans.create', compact('penerimas'));
    }

    // Menyimpan laporan baru
    public function store(Request $request)
    {
        $request->validate([
            'id_penerima' => 'required|exists:penerimas,id',
            'judul_laporan' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:baru mulai,progres,selesai',
            'tanggal_mulai' => 'nullable|date', // Menjadikan nullable
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai', // Menjadikan nullable
            'tgl_laporan' => 'nullable|date', // Menjadikan nullable
        ]);

        // Tambahkan user_id dari pengguna yang login
        $validated['user_id'] = Auth::id();

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->extension();
            $filePath = $file->storeAs('public/uploads', $fileName);
            $data['foto'] = basename($filePath);
        }

        Laporan::create($data);

        return redirect()->route('laporans.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    // Menampilkan detail laporan
    public function show(Laporan $laporan)
    {
        return view('laporans.show', compact('laporan'));
    }

    // Menampilkan form edit laporan
    public function edit(Laporan $laporan)
    {
        $penerimas = Penerima::all();
        return view('laporans.edit', compact('laporan', 'penerimas'));
    }

    // Memperbarui laporan
    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'id_penerima' => 'required|exists:penerimas,id',
            'judul_laporan' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:baru mulai,progres,selesai',
            'tanggal_mulai' => 'nullable|date', // Menjadikan nullable
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai', // Menjadikan nullable
            'tgl_laporan' => 'nullable|date', // Menjadikan nullable
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($laporan->foto && Storage::exists('public/uploads/' . $laporan->foto)) {
                Storage::delete('public/uploads/' . $laporan->foto);
            }

            // Simpan foto baru
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->extension();
            $filePath = $file->storeAs('public/uploads', $fileName);
            $data['foto'] = basename($filePath);
        }

        $laporan->update($data);

        return redirect()->route('laporans.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function download(Request $request)
    {
        $search = $request->input('search');

        // Get filtered laporans
        $laporans = Laporan::with('penerima')
            ->when($search, function ($query, $search) {
                return $query->where('judul_laporan', 'like', "%{$search}%");
            })
            ->get();

        // Create CSV data
        $csvData = "Judul Laporan, Isi Laporan, Penerima, Status, Tanggal Mulai, Tanggal Selesai\n";
        foreach ($laporans as $laporan) {
            $csvData .= "\"{$laporan->judul_laporan}\",\"{$laporan->isi_laporan}\",\"{$laporan->penerima->nama}\",\"{$laporan->status}\",\"{$laporan->tanggal_mulai}\",\"{$laporan->tanggal_selesai}\"\n";
        }

        $fileName = 'laporans_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        return response()->make($csvData, 200, $headers);
    }



    // Menghapus laporan
    public function destroy(Laporan $laporan)
    {
        // Hapus foto jika ada
        if ($laporan->foto && Storage::exists('public/uploads/' . $laporan->foto)) {
            Storage::delete('public/uploads/' . $laporan->foto);
        }

        // Hapus laporan dari database
        $laporan->delete();

        return redirect()->route('laporans.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
