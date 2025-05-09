<?php

namespace App\Http\Controllers;

use App\Models\Penerima;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PenerimaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,petugas_lapangan')->except(['index', 'create', 'edit', 'download']);
    }

    public function index(Request $request)
        {
        $query = Penerima::query();
        $perPage = $request->get('perPage', 10);
        // Pencarian
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('kondisi_jamban', 'like', '%' . $search . '%')
                  ->orWhere('kendala', 'like', '%' . $search . '%')
                  ->orWhere('jml_penghuni', 'like', '%' . $search . '%')
                  ->orWhere('pekerjaan', 'like', '%' . $search . '%')
                  ->orWhere('sumber_air', 'like', '%' . $search . '%')
                  ->orWhere('desa', 'like', '%' . $search . '%');
            });
        }
    
        // Pagination
        $penerimas = $query->paginate($perPage); // Sesuaikan jumlah data per halaman
        return view('penerimas.index', compact('penerimas'));
    }
    
    public function download()
    {
        $penerimas = Penerima::all();

        $filename = "data_penerima.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['Nama', 'Desa', 'Kondisi Jamban', 'Kebutuhan', 'Jumlah Penghuni', 'Pekerjaan', 'Sumber Air', 'No Telepon']);

        foreach ($penerimas as $penerima) {
            fputcsv($handle, [
                $penerima->nama,
                $penerima->desa,
                $penerima->kondisi_jamban,
                $penerima->kendala,
                $penerima->jml_penghuni,
                $penerima->pekerjaan,
                $penerima->sumber_air,
                $penerima->no_telepon,
            ]);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }


    // Menampilkan form untuk menambah penerima baru
    public function create()
    {
        return view('penerimas.create');
    }

    // Menyimpan data penerima baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'desa' => 'required',
            'kondisi_jamban' => 'required',
            'kendala' => 'required',
            'jml_penghuni' => 'required|integer',
            'pekerjaan' => 'required',
            'sumber_air' => 'required',
            'no_telepon' => 'required|string'
        ]);

        Penerima::create($request->all());

        return redirect()->route('penerimas.index')->with('success', 'Penerima berhasil ditambahkan.');
    }

    // Menampilkan detail penerima
    public function show(Penerima $penerima)
    {
        return view('penerimas.show', compact('penerima'));
    }

    // Menampilkan form edit data penerima
    public function edit(Penerima $penerima)
    {
        return view('penerimas.edit', compact('penerima'));
    }

    // Memperbarui data penerima
    public function update(Request $request, Penerima $penerima)
    {
        $request->validate([
            'nama' => 'required',
            'desa' => 'required',
            'kondisi_jamban' => 'required',
            'kendala' => 'required',
            'jml_penghuni' => 'required|integer',
            'pekerjaan' => 'required',
            'sumber_air' => 'required',
            'no_telepon' => 'required|string'
        ]);

        $penerima->update($request->all());

        return redirect()->route('penerimas.index')->with('success', 'Data penerima berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penerima = Penerima::find($id);

        if (!$penerima) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $penerima->delete();

        return redirect()->route('penerimas.index')->with('success', 'Data berhasil dihapus.');
    }

}
