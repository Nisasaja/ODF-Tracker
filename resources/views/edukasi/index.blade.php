@extends('partial.main')

@section('body')
<div class="container">
    <h1 class="mb-4">Daftar Edukasi</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('edukasi.create') }}" class="btn btn-primary mb-3">Tambah Edukasi</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Jenis</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($edukasi as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ ucfirst($item->jenis) }}</td>
                    <td>
                        @if ($item->gambar)
                            <img src="{{ asset('storage/edukasi/' . $item->gambar) }}" alt="Gambar" width="100">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('edukasi.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('edukasi.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('edukasi.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus edukasi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data edukasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $edukasi->links() }}
</div>
@endsection
