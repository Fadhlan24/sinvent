@extends('layouts.adm-main')

@section('content')
<div class="card-body">
    <h2 class="mb-4 text-center font-weight-bold" style="color: #4CAF50;">Daftar Barang Keluar</h2>
    <div class="row mb-3">
        <div class="col-md-8">
            <a href="{{ route('barangkeluar.create') }}" class="btn btn-md btn-success mb-2">TAMBAH BARANG KELUAR</a>
        </div>
        <div class="col-md-4">
            <form action="{{ route('barangkeluar.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari barang keluar..." value="{{ request()->input('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                    @if(request()->filled('search'))
                        <div class="input-group-append">
                            <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary"><i class="fa fa-times"></i></a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Tanggal Keluar</th>
                <th scope="col">Jumlah Keluar</th>
                <th scope="col">Stok Barang</th>
                <th scope="col">Barang</th>
                <th scope="col" style="width: 20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($Barangkeluar as $bk)
                <tr class="text-center">
                    <td>{{ ($Barangkeluar->currentPage() - 1) * $Barangkeluar->perPage() + $loop->index + 1 }}</td>
                    <td>{{ $bk->tgl_keluar }}</td>
                    <td>{{ $bk->qty_keluar }}</td>
                    <td>{{ $bk->barang->stok }}</td>
                    <td>{{ $bk->barang->merk }} - {{ $bk->barang->seri }}</td>
                    <td class="text-center">
                        <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');"
                            action="{{ route('barangkeluar.destroy', $bk->id) }}" method="POST">
                            <a href="{{ route('barangkeluar.show', $bk->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                            <a href="{{ route('barangkeluar.edit', $bk->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        <div class="alert alert-danger">
                            Data Barang belum Tersedia.
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $Barangkeluar->links('pagination::bootstrap-4') }}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // message with sweetalert
    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('Gagal'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('Gagal') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endsection