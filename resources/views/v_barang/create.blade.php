@extends('layouts.adm-main')

@section('content')
<div class="card border-0 shadow-sm rounded">
    <div class="card-header bg-transparent border-bottom-0">
        <h5 class="mb-0">Tambah Barang</h5>
    </div>
        <div class="card-body">
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label class="font-weight-bold">Merk</label>
                    <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror"
                        placeholder="Masukkan Merk Barang" required>
                    @error('merk')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Seri</label>
                    <input type="text" name="seri" class="form-control @error('seri') is-invalid @enderror"
                        placeholder="Masukkan Seri Barang" required>
                    @error('seri')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Spesifikasi</label>
                    <textarea name="spesifikasi" class="form-control @error('spesifikasi') is-invalid @enderror"
                        rows="5" placeholder="Masukkan Spesifikasi Barang" required></textarea>
                    @error('spesifikasi')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Kategori</label>
                    <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->deskripsi }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Foto</label>
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" required>
                    @error('foto')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                <button type="reset" class="btn btn-md btn-warning">RESET</button>
                <a href="{{ route('barang.index') }}" class="btn btn-md btn-secondary">KEMBALI</a>
            </form>
        </div>
    </div>
</div>
@endsection