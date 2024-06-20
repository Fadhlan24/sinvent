@extends('layouts.adm-main')

@section('content')
<div class="card-body">
    <h2 class="mb-4 text-center font-weight-bold" style="color: #4CAF50;">Daftar Kategori</h2>
    <div class="row mb-3">
        <div class="col-md-8">
            <a href="{{ route('kategori.create') }}" class="btn btn-md btn-success mb-2">TAMBAH KATEGORI</a>
        </div>
        <div class="col-md-4">
            <form action="{{ route('kategori.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari kategori..." value="{{ request()->input('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                    @if(request()->filled('search'))
                        <div class="input-group-append">
                            <a href="{{ route('kategori.index') }}" class="btn btn-secondary"><i class="fa fa-times"></i></a>
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
                <th scope="col">Kategori</th>
                <th scope="col">Keterangan Kategori</th>
                <th scope="col">Deskripsi</th>
                <th scope="col" style="width: 20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rsetKategori as $kategori)
                <tr class="text-center">
                    <td>{{ ($rsetKategori->currentPage() - 1) * $rsetKategori->perPage() + $loop->index + 1 }}</td>
                    <td>{{ $kategori->kategori }}</td>
                    <td>{{ $kategori->ketKategori }}</td>
                    <td>{{ $kategori->deskripsi }}</td>
                    <td class="text-center">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                            action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                            <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        <div class="alert alert-danger">
                            Data Kategori belum Tersedia.
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $rsetKategori->links('pagination::bootstrap-4') }}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    //message with sweetalert
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