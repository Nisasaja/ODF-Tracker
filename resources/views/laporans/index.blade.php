@extends('partial.main')

@section('body')
<div class="container mt-5">
        {{-- Header --}}
        <div class="mb-4 text-center">
            <h1 class="text-primary" style="font-size: 2rem;">Laporan ODF</h1>
        </div>

        {{-- Pesan Sukses --}}
        @if(session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif

        {{-- Form dan Tombol dalam Satu Garis --}}
        <div class="mb-4 p-3" style="background-color: #d0ebff; border-radius: 10px;">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <form action="{{ route('laporans.index') }}" method="GET" class="d-flex align-items-center me-3">
                    <label for="perPage" class="me-2">Tampilkan:</label>
                    <select name="perPage" id="perPage" class="form-select form-select-sm" onchange="this.form.submit()" style="max-width: 100px;">
                        <option value="5" {{ request()->get('perPage') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request()->get('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request()->get('perPage') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request()->get('perPage') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </form>
               {{-- Form Pencarian --}}
                <form action="{{ route('laporans.index') }}" method="GET" class="d-flex flex-grow-1 mx-2" style="max-width: 300px;">
                    <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari laporan..." value="{{ request()->get('search') }}" style="font-size: 0.875rem;">
                    <button type="submit" class="btn btn-secondary btn-sm" style="font-size: 0.875rem;">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
                {{-- Tombol Tambah --}}
                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'petugas_lapangan')
                <a href="{{ route('laporans.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Laporan
                </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Tabel Laporan --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    {{--  <th>Dilaporkan Oleh</th>  --}}
                    <th>Nama Penerima</th>
                    <th>Status</th>
                    <th>Tanggal Laporan</th>
                    <th>Judul Laporan</th>
                    <th>Foto Kegiatan</th>
                    <th>Isi Laporan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporans as $laporan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{--  <td>{{ $laporan->user ? $laporan->user->name : 'Tidak Diketahui' }}</td>  --}}
                        <td>{{ $laporan->penerima->nama }}</td>
                        <td>
                            <span class="badge {{ $laporan->status === 'selesai' ? 'bg-success' : 'bg-warning' }}">
                                {{ ucfirst($laporan->status) }}
                            </span>
                        </td>
                        <td>{{ $laporan->tgl_laporan ? \Carbon\Carbon::parse($laporan->tgl_laporan)->format('d-m-Y') : '-' }}</td>
                        <td>{{ $laporan->judul_laporan }}</td>
                        <td>
                            @if($laporan->foto)
                                <img src="{{ asset('storage/uploads/' . $laporan->foto) }}" alt="Foto Laporan" class="img-thumbnail" style="max-width: 100px;">
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($laporan->isi_laporan, 50, '...') }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('laporans.edit', $laporan->id) }}" class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('laporans.destroy', $laporan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Data laporan tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $laporans->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
