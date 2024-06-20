@extends('layouts.adm-main')

@section('content')
<div class="card-body">
    <h2 class="mb-4 text-center font-weight-bold" style="color: #4CAF50;">Daftar Barang</h2>
    <div class="row mb-3">
        <div class="col-md-8">
            <a href="{{ route('barang.create') }}" class="btn btn-md btn-success mb-2">TAMBAH BARANG</a>
        </div>
        <div class="col-md-4">
            <form action="{{ route('barang.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari barang..."
                        value="{{ request()->input('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                    @if(request()->filled('search'))
                        <div class="input-group-append">
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary"><i
                                    class="fa fa-times"></i></a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('Gagal'))
        <div class="alert alert-danger">
            {{ session('Gagal') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Merk</th>
                    <th scope="col">Seri</th>
                    <th scope="col">Spesifikasi</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Foto</th>
                    <th scope="col" style="width: 20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rsetBarang as $rowbarang)
                    <tr class="text-center">
                        <td>{{ ($rsetBarang->currentPage() - 1) * $rsetBarang->perPage() + $loop->index + 1 }}</td>
                        <td>{{ $rowbarang->merk }}</td>
                        <td>{{ $rowbarang->seri }}</td>
                        <td>{{ $rowbarang->spesifikasi }}</td>
                        <td>{{ $rowbarang->stok }}</td>
                        <td>{{ $rowbarang->kategori->deskripsi }}</td>
                        <td>
                            <img src="{{ asset('storage/foto/' . $rowbarang->foto) }}" class="rounded" style="width: 150px">
                        </td>
                        <td>
                            <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');"
                                action="{{ route('barang.destroy', $rowbarang->id) }}" method="POST" style="display:inline">
                                <a href="{{ route('barang.show', $rowbarang->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                <a href="{{ route('barang.edit', $rowbarang->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            <div class="alert alert-danger">
                                Data Barang belum Tersedia.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {!! $rsetBarang->links() !!}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Message with SweetAlert
    @if(session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>

@endsection