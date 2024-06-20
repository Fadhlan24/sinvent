@extends('layouts.adm-main')

@section('content')
<div class="card border-0 shadow-sm rounded">
    <div class="card-header bg-transparent border-bottom-0">
        <h5 class="mb-0">Detail Barang Keluar</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-4">
                    <label class="font-weight-bold">TANGGAL MASUK</label>
                    <h3 class="text-primary">{{ $barangmasuk->tgl_masuk }}</h3>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">JUMLAH MASUK</label>
                    <h3 class="text-primary">{{ $barangmasuk->qty_masuk }}</h3>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">MERK</label>
                    <h3 class="text-primary">{{ $barangmasuk->barang->merk }}</h3>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">SERI</label>
                    <h3 class="text-primary">{{ $barangmasuk->barang->seri }}</h3>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">SPESIFIKASI</label>
                    <h3 class="text-primary">{{ $barangmasuk->barang->spesifikasi }}</h3>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">KATEGORI</label>
                    <h3 class="text-primary">{{ $barangmasuk->barang->kategori->deskripsi }}</h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('storage/foto/' . $barangmasuk->barang->foto) }}" class="w-100 rounded">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('barangmasuk.index') }}" class="btn btn-secondary">KEMBALI</a>
        </div>
    </div>
</div>
@endsection

@php
function formatTanggal($tanggal)
{
    $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $tgl = strtotime($tanggal);
    $namaHari = $hari[date('w', $tgl)];
    $namaBulan = $bulan[date('n', $tgl) - 1];
    $tanggalFormatted = sprintf('%s, %d %s %d', $namaHari, date('j', $tgl), $namaBulan, date('Y', $tgl));

    return $tanggalFormatted;
}
@endphp