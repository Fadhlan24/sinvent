@extends('layouts.adm-main')

@section('content')
<div class="card border-0 shadow-sm rounded">
    <div class="card-header bg-transparent border-bottom-0">
        <h5 class="mb-0">Detail Barang</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label class="font-weight-bold">MERK</label>
                    <h3 class="text-primary">{{ $rsetBarang->merk }}</h3>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">SERI</label>
                    <h3 class="text-primary">{{ $rsetBarang->seri }}</h3>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">SPESIFIKASI</label>
                    <h3 class="text-primary">{{ $rsetBarang->spesifikasi }}</h3>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">KATEGORI</label>
                    <h3 class="text-primary">{{ $rsetBarang->kategori->deskripsi }}</h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('storage/foto/' . $rsetBarang->foto) }}" class="w-100 rounded">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">KEMBALI</a>
        </div>
    </div>
    @endsection