<?php

namespace App\Http\Controllers;

use App\Models\Edukasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EdukasiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('role:admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
        $this->middleware('role:petugas_lapangan')->only('index');
    }

    /**
     * Menampilkan daftar edukasi.
     */
    public function index()
    {
        $edukasi = Edukasi::orderBy('created_at', 'desc')->paginate(10);
        return view('edukasi.index', compact('edukasi'));
    }

    /**
     * Menampilkan form untuk membuat edukasi baru.
     */
    public function create()
    {
        return view('edukasi.create');
    }

    /**
     * Menyimpan edukasi baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|in:artikel,video',
            'isi' => 'required_if:jenis,artikel',
            'video_url' => 'nullable|url|required_if:jenis,video',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['judul', 'isi', 'video_url', 'jenis']);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('public/edukasi');
            $data['gambar'] = basename($path);
        }

        Edukasi::create($data);

        return redirect()->route('edukasi.index')->with('success', 'Edukasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail edukasi.
     */
    public function show(Edukasi $edukasi)
    {
        return view('edukasi.show', compact('edukasi'));
    }

    /**
     * Menampilkan form untuk mengedit edukasi.
     */
    public function edit(Edukasi $edukasi)
    {
        return view('edukasi.edit', compact('edukasi'));
    }

    /**
     * Memperbarui edukasi di database.
     */
    public function update(Request $request, Edukasi $edukasi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|in:artikel,video',
            'isi' => 'required_if:jenis,artikel',
            'video_url' => 'nullable|url|required_if:jenis,video',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['judul', 'isi', 'video_url', 'jenis']);

        if ($request->hasFile('gambar')) {
            if ($edukasi->gambar && Storage::exists('public/edukasi/' . $edukasi->gambar)) {
                Storage::delete('public/edukasi/' . $edukasi->gambar);
            }

            $path = $request->file('gambar')->store('public/edukasi');
            $data['gambar'] = basename($path);
        }

        $edukasi->update($data);

        return redirect()->route('edukasi.index')->with('success', 'Edukasi berhasil diperbarui.');
    }

    /**
     * Menghapus edukasi dari database.
     */
    public function destroy(Edukasi $edukasi)
    {
        if ($edukasi->gambar && Storage::exists('public/edukasi/' . $edukasi->gambar)) {
            Storage::delete('public/edukasi/' . $edukasi->gambar);
        }

        $edukasi->delete();

        return redirect()->route('edukasi.index')->with('success', 'Edukasi berhasil dihapus.');
    }
}
