@extends('partial.main')

@section('body')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="fas fa-user me-2"></i>
            <h5 class="mb-0">Edit Penerima</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('penerimas.update', $penerima->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" class="form-control" value="{{ $penerima->nama }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="desa">Desa:</label>
                    <select name="desa" class="form-control" required>
                        <option value="Salimbatu" {{ $penerima->desa == 'Salimbatu' ? 'selected' : '' }}>Salimbatu</option>
                        <option value="Sekatak" {{ $penerima->desa == 'Sekatak' ? 'selected' : '' }}>Sekatak</option>
                        <option value="Wonomulyo" {{ $penerima->desa == 'Wonomulyo' ? 'selected' : '' }}>Wonomulyo</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="kondisi_jamban">Kondisi Jamban:</label>
                    <select name="kondisi_jamban" class="form-control" required>
                        <option value="Tidak Ada" {{ $penerima->kondisi_jamban == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                        <option value="Rusak Berat" {{ $penerima->kondisi_jamban == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        <option value="Rusak Ringan" {{ $penerima->kondisi_jamban == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="kendala">Kebutuhan:</label>
                    <textarea name="kendala" class="form-control" required>{{ $penerima->kendala }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="jml_penghuni">Jumlah Penghuni:</label>
                    <input type="number" name="jml_penghuni" class="form-control" value="{{ $penerima->jml_penghuni }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="pekerjaan">Pekerjaan:</label>
                    <input type="text" name="pekerjaan" class="form-control" value="{{ $penerima->pekerjaan }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="sumber_air">Sumber Air:</label>
                    <input type="text" name="sumber_air" class="form-control" value="{{ $penerima->sumber_air }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="no_telepon">No Telepon:</label>
                    <input type="text" name="no_telepon" class="form-control" value="{{ $penerima->no_telepon }}" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
