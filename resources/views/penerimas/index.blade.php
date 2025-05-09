@extends('partial.main')

@section('body')
<div class="container mt-5">
    <div class="container mt-5">
        <div class="mb-4 py-3" style="background-color: #ffff; border-radius: 10px;">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="text-primary text-center flex-grow-1 mb-0" style="font-size: 2rem;">Daftar Penerima</h1>
            </div>
        </div>
    
        {{-- Pesan Sukses --}}
        @if(session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        @endif
    
        <div class="mb-3 d-flex justify-content-between align-items-center" style="background-color: #d0ebff; padding: 10px; border-radius: 10px;">
            <form action="{{ route('penerimas.index') }}" method="GET" class="d-flex align-items-center me-3">
                <label for="perPage" class="me-2">Tampilkan:</label>
                <select name="perPage" id="perPage" class="form-select form-select-sm" onchange="this.form.submit()" style="max-width: 100px;">
                    <option value="10" {{ request()->get('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request()->get('perPage') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request()->get('perPage') == 50 ? 'selected' : '' }}>50</option>
                </select>
            </form>
            <form action="{{ route('penerimas.index') }}" method="GET" class="d-flex mb-0">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari penerima..." value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-secondary">
                    <i class="fas fa-search"></i> Cari
                </button>
            </form>
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'petugas_lapangan')
            <a href="{{ route('penerimas.create') }}" class="btn btn-primary ms-3">
                <i class="fas fa-plus"></i> Tambah Profile
            </a>
            @endif
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle">
            <thead class="bg-dark text-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Desa</th>
                    <th>Kondisi Jamban</th>
                    <th>Kebutuhan</th>
                    <th>Jumlah Penghuni</th>
                    <th>Pekerjaan</th>
                    <th>Sumber Air</th>
                    <th>No Telepon</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penerimas as $penerima)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $penerima->nama }}</td>
                    <td>{{ $penerima->desa }}</td>
                    <td>{{ $penerima->kondisi_jamban }}</td>
                    <td>{{ $penerima->kendala }}</td>
                    <td>{{ $penerima->jml_penghuni }}</td>
                    <td>{{ $penerima->pekerjaan }}</td>
                    <td>{{ $penerima->sumber_air }}</td>
                    <td>{{ $penerima->no_telepon }}</td>
                    <td class="text-center">
                        <a href="{{ route('penerimas.edit', $penerima->id) }}" class="btn btn-sm btn-warning me-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('penerimas.destroy', $penerima->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">Data tidak ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $penerimas->links('pagination::bootstrap-4') }}
    </div>
</div>

<script>
    const downloadUrl = "{{ route('penerimas.download') }}";
</script>
<script src="{{ asset('js/download.js') }}"></script>
@endsection
