@extends('partial.main')

@section('body')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <h4 class="mb-0">
                <i class="fas fa-user me-2"></i>
                {{ isset($penerima) ? 'Edit Profil Penerima' : 'Tambah Data Profil Penerima' }}
            </h4>
        </div>
        <div class="card-body p-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ isset($penerima) ? route('penerimas.update', $penerima->id) : route('penerimas.store') }}" method="POST" novalidate>
                @csrf
                @if(isset($penerima))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama penerima" value="{{ old('nama', isset($penerima) ? $penerima->nama : '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="desa" class="form-label">Desa</label>
                    <select name="desa" id="desa" class="form-select" required>
                        <option value="" disabled selected>Pilih Desa</option>
                        <option value="Salimbatu" {{ isset($penerima) && $penerima->desa == 'Salimbatu' ? 'selected' : '' }}>Salimbatu</option>
                        <option value="Sekatak" {{ isset($penerima) && $penerima->desa == 'Sekatak' ? 'selected' : '' }}>Sekatak</option>
                        <option value="Wonomulyo" {{ isset($penerima) && $penerima->desa == 'Wonomulyo' ? 'selected' : '' }}>Wonomulyo</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kondisi_jamban" class="form-label">Kondisi Jamban</label>
                    <select name="kondisi_jamban" id="kondisi_jamban" class="form-select" required>
                        <option value="" disabled selected>Pilih Kondisi</option>
                        <option value="Tidak Ada" {{ isset($penerima) && $penerima->kondisi_jamban == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                        <option value="Rusak Berat" {{ isset($penerima) && $penerima->kondisi_jamban == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        <option value="Rusak Ringan" {{ isset($penerima) && $penerima->kondisi_jamban == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kendala" class="form-label">Kebutuhan</label>
                    <textarea name="kendala" id="kendala" class="form-control" rows="3" placeholder="Masukkan kebutuhan atau kendala" required>{{ old('kendala', isset($penerima) ? $penerima->kendala : '') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="jml_penghuni" class="form-label">Jumlah Penghuni</label>
                        <input type="number" name="jml_penghuni" id="jml_penghuni" class="form-control" placeholder="Masukkan jumlah penghuni" value="{{ old('jml_penghuni', isset($penerima) ? $penerima->jml_penghuni : '') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pekerjaan" class="form-label">Pekerjaan</label>
                        <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Masukkan pekerjaan" value="{{ old('pekerjaan', isset($penerima) ? $penerima->pekerjaan : '') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sumber_air" class="form-label">Sumber Air</label>
                        <input type="text" name="sumber_air" id="sumber_air" class="form-control" placeholder="Masukkan sumber air" value="{{ old('sumber_air', isset($penerima) ? $penerima->sumber_air : '') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="no_telepon" class="form-label">No Telepon</label>
                        <input type="text" name="no_telepon" id="no_telepon" class="form-control" placeholder="Masukkan no telepon" value="{{ old('no_telepon', isset($penerima) ? $penerima->no_telepon : '') }}" required>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4 py-2">
                        {{ isset($penerima) ? 'Perbarui' : 'Simpan' }}
                    </button>
                    <a href="{{ route('penerimas.index') }}" class="btn btn-secondary px-4 py-2">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
