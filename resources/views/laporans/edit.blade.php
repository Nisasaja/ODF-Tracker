@extends('partial.main')

@section('body')
<h1>Edit Laporan</h1>

<!-- Menampilkan pesan error validasi -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Form untuk mengedit laporan -->
<form action="{{ route('laporans.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Pilihan Nama Penerima -->
    <div class="form-group">
        <label for="id_penerima">Nama Penerima:</label>
        <select name="id_penerima" class="form-control @error('id_penerima') is-invalid @enderror" required>
            @foreach ($penerimas as $penerima)
                <option value="{{ $penerima->id }}" {{ old('id_penerima', $laporan->id_penerima) == $penerima->id ? 'selected' : '' }}>
                    {{ $penerima->nama }}
                </option>
            @endforeach
        </select>
        @error('id_penerima')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Input untuk Judul Laporan -->
    <div class="form-group">
        <label for="judul_laporan">Judul Laporan:</label>
        <input type="text" name="judul_laporan" class="form-control @error('judul_laporan') is-invalid @enderror" value="{{ old('judul_laporan', $laporan->judul_laporan) }}" required>
        @error('judul_laporan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Input untuk Status Laporan -->
    <div class="form-group">
        <label for="status">Status:</label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="baru mulai" {{ old('status', $laporan->status) == 'baru mulai' ? 'selected' : '' }}>Baru Mulai</option>
            <option value="progres" {{ old('status', $laporan->status) == 'progres' ? 'selected' : '' }}>Progres</option>
            <option value="selesai" {{ old('status', $laporan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Input untuk Tanggal Mulai -->
    <div class="form-group">
        <label for="tanggal_mulai">Tanggal Mulai:</label>
        <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai', $laporan->tanggal_mulai) }}" required>
        @error('tanggal_mulai')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Input untuk Tanggal Selesai -->
    <div class="form-group">
        <label for="tanggal_selesai">Tanggal Selesai:</label>
        <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai', $laporan->tanggal_selesai) }}" required>
        @error('tanggal_selesai')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Input untuk Foto Laporan -->
    <div class="form-group">
        <label for="foto">Foto Laporan:</label>
        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
        @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if($laporan->foto)
        <div class="mt-2">
            <img src="{{ asset('storage/uploads/' . $laporan->foto) }}" alt="Foto Laporan" class="img-thumbnail" style="max-width: 200px;">
        </div>
        @endif
    </div>

    <!-- Input untuk Isi Laporan -->
    <div class="form-group">
        <label for="isi_laporan">Isi Laporan:</label>
        <textarea name="isi_laporan" class="form-control @error('isi_laporan') is-invalid @enderror" placeholder="Deskripsikan isi laporan" required>{{ old('isi_laporan', $laporan->isi_laporan) }}</textarea>
        @error('isi_laporan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Tombol Simpan -->
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
