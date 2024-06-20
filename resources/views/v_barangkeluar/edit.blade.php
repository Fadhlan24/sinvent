@extends('layouts.adm-main')

@section('content')
<div class="card border-0 shadow-sm rounded">
    <div class="card-header bg-transparent border-bottom-0">
        <h5 class="mb-0">Edit Barang Keluar</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('barangkeluar.update', $barangkeluar->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="tgl_keluar" class="font-weight-bold">Tanggal Keluar</label>
                <input type="date" id="tgl_keluar" name="tgl_keluar" class="form-control @error('tgl_keluar') is-invalid @enderror" value="{{ old('tgl_keluar', $barangkeluar->tgl_keluar) }}" required>
                @error('tgl_keluar')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="qty_keluar" class="font-weight-bold">Jumlah Keluar</label>
                <input type="number" id="qty_keluar" name="qty_keluar" class="form-control @error('qty_keluar') is-invalid @enderror" value="{{ old('qty_keluar', $barangkeluar->qty_keluar) }}" required>
                @error('qty_keluar')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="barang_id" class="font-weight-bold">Barang</label>
                <select id="barang_id" name="barang_id" class="form-control @error('barang_id') is-invalid @enderror" required>
                    @foreach($barangOptions as $barang)
                    <option value="{{ $barang->id }}" {{ old('barang_id', $barangkeluar->barang_id) == $barang->id ? 'selected' : '' }}>{{ $barang->merk }} - {{ $barang->seri }}</option>
                    @endforeach
                </select>
                @error('barang_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
            <button type="reset" class="btn btn-md btn-warning">RESET</button>
            <a href="{{ route('barangkeluar.index') }}" class="btn btn-md btn-primary">KEMBALI</a>
        </form>
    </div>
</div>
@endsection