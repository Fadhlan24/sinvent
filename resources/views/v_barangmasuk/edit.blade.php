@extends('layouts.adm-main')

@section('content')
<div class="card border-0 shadow-sm rounded">
    <div class="card-header bg-transparent border-bottom-0">
        <h5 class="mb-0">Edit Barang Masuk</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('barangmasuk.update', $rsetBarangmasuk->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label class="font-weight-bold">Tanggal Masuk</label>
                <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk"
                    value="{{ old('tgl_masuk', $rsetBarangmasuk->tgl_masuk) }}" required>
                @error('tgl_masuk')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">Jumlah Masuk</label>
                <input type="number" class="form-control @error('qty_masuk') is-invalid @enderror" name="qty_masuk"
                    value="{{ old('qty_masuk', $rsetBarangmasuk->qty_masuk) }}" required min="1">
                @error('qty_masuk')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="font-weight-bold">Barang:</label>
                <select id="barang_id" name="barang_id" class="form-control @error('barang_id') is-invalid @enderror" required>
                    @foreach($barangOptions as $barang)
                    <option value="{{ $barang->id }}" {{ old('barang_id', $rsetBarangmasuk->barang_id) == $barang->id ? 'selected' : '' }}>{{ $barang->merk }} - {{ $barang->seri }}</option>
                    @endforeach
                </select>
                @error('barang_id')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
            <button type="reset" class="btn btn-md btn-warning">RESET</button>
            <a href="{{ route('barangmasuk.index') }}" class="btn btn-md btn-primary">KEMBALI</a>
        </form>
    </div>
</div>
@endsection