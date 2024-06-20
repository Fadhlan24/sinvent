@extends('layouts.adm-main')

@section('content')
<div class="card border-0 shadow-sm rounded">
    <div class="card-header bg-transparent border-bottom-0">
        <h5 class="mb-0">Tambah Kategori</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="font-weight-bold">KATEGORI</label>
                <select class="form-control @error('kategori') is-invalid @enderror" name="kategori">
                    <option value="" selected disabled>-- Pilih Kategori --</option>
                    <option value="M">Modal</option>
                    <option value="A">Alat</option>
                    <option value="BHP">Bahan Habis Pakai</option>
                    <option value="BTHP">Bahan Tidak Habis Pakai</option>
                </select>
                @error('kategori')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">DESKRIPSI</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="5" placeholder="Masukkan Deskripsi Kategori">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
            <button type="reset" class="btn btn-md btn-warning">RESET</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-md btn-secondary">KEMBALI</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection