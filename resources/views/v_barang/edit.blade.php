@extends('layouts.adm-main')

@section('content')
<div class="card border-0 shadow-sm rounded">
    <div class="card-header bg-transparent border-bottom-0">
        <h5 class="mb-0">Edit Barang</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('barang.update', $rsetBarang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label class="font-weight-bold">MERK</label>
                <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk"
                    value="{{ old('merk', $rsetBarang->merk) }}" placeholder="Masukkan Merk Barang" required>
                @error('merk')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">SERI</label>
                <input type="text" class="form-control @error('seri') is-invalid @enderror" name="seri"
                    value="{{ old('seri', $rsetBarang->seri) }}" placeholder="Masukkan Seri Barang" required>
                @error('seri')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">SPESIFIKASI</label>
                <input type="text" class="form-control @error('spesifikasi') is-invalid @enderror" name="spesifikasi"
                    value="{{ old('spesifikasi', $rsetBarang->spesifikasi) }}" placeholder="Masukkan Spesifikasi Barang"
                    required>
                @error('spesifikasi')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">KATEGORI</label>
                <select class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id" required>
                    <option value="" selected disabled>-- Pilih Kategori --</option>
                    @foreach ($akategori as $kategori)
                    <option value="{{ $kategori->id }}" {{ $kategori->id == $rsetBarang->kategori_id ? 'selected' : '' }}>
                        {{ $kategori->deskripsi }}</option>
                    @endforeach
                </select>
                @error('kategori_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">FOTO</label>
                <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                @error('foto')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
            <a href="{{ route('barang.index') }}" class="btn btn-md btn-warning">KEMBALI</a>
        </form>
    </div>
</div>
@endsection