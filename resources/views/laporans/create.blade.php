@extends('partial.main')

@section('body')
<h1 class="mb-4">Buat Laporan Baru</h1>

<!-- Menampilkan pesan error validasi -->
@if ($errors->any())
    <div class="alert alert-danger mb-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Form untuk menambahkan laporan baru -->
<form action="{{ route('laporans.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
        <!-- Pilihan Nama Penerima -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="id_penerima">Nama Penerima:</label>
                <select name="id_penerima" class="form-select @error('id_penerima') is-invalid @enderror" required>
                    <option value="" disabled selected>Pilih Penerima</option>
                    @foreach ($penerimas as $penerima)
                        <option value="{{ $penerima->id }}">{{ $penerima->nama }}</option>
                    @endforeach
                </select>
                @error('id_penerima')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Input untuk Tanggal Laporan Mingguan -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="tgl_laporan">Tanggal Laporan Mingguan:</label>
                <input type="date" name="tgl_laporan" class="form-control @error('tgl_laporan') is-invalid @enderror" value="{{ old('tgl_laporan', isset($laporan) ? $laporan->tgl_laporan : '') }}" required>
                @error('tgl_laporan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Input untuk Judul Laporan -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="judul_laporan">Judul Laporan:</label>
                <input type="text" name="judul_laporan" class="form-control @error('judul_laporan') is-invalid @enderror" placeholder="Masukkan judul laporan" value="{{ old('judul_laporan') }}" required>
                @error('judul_laporan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Input untuk Status Laporan -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="baru mulai" {{ old('status') == 'baru mulai' ? 'selected' : '' }}>Baru Mulai</option>
                    <option value="progres" {{ old('status') == 'progres' ? 'selected' : '' }}>Progres</option>
                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Input untuk Tanggal Mulai -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggal_mulai">Tanggal Mulai:</label>
                <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai') }}" required>
                @error('tanggal_mulai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Input untuk Tanggal Selesai -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggal_selesai">Tanggal Selesai:</label>
                <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror" value="{{ old('tanggal_selesai') }}" required>
                @error('tanggal_selesai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Input untuk Foto Laporan -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="foto">Foto Laporan:</label>
                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Input untuk Isi Laporan -->
        <div class="col-12">
            <div class="form-group">
                <label for="isi_laporan">Isi Laporan:</label>
                <textarea name="isi_laporan" class="form-control @error('isi_laporan') is-invalid @enderror" placeholder="Deskripsikan isi laporan" required>{{ old('isi_laporan') }}</textarea>
                @error('isi_laporan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Tombol Simpan dan Kembali -->
    <div class="mt-4 d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('laporans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</form>
@endsection
