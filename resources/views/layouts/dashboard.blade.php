@extends('layouts.adm-main')

@section('content')
    <section class="hero py-5">
        <div class="container text-center">
            <h1 class="font-weight-bold">SIJA INVENTORY</h1>
        </div>
    </section>

    <section id="features" class="features py-5">
        <div class="container">
            <div class="row mt-4 d-flex">
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card border-0 shadow rounded flex-fill d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column">
                            <h4 class="font-weight-bold flex-grow-1 d-flex align-items-center justify-content-center">Kategori</h4>
                            <a href="{{ route('kategori.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Kategori</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card border-0 shadow rounded flex-fill d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column">
                            <h4 class="font-weight-bold flex-grow-1 d-flex align-items-center justify-content-center">Barang</h4>
                            <a href="{{ route('barang.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Barang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card border-0 shadow rounded flex-fill d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column">
                            <h4 class="font-weight-bold flex-grow-1 d-flex align-items-center justify-content-center">Barang Masuk</h4>
                            <a href="{{ route('barangmasuk.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Barang Masuk</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card border-0 shadow rounded flex-fill d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column">
                            <h4 class="font-weight-bold flex-grow-1 d-flex align-items-center justify-content-center">Barang Keluar</h4>
                            <a href="{{ route('barangkeluar.index') }}" class="btn btn-outline-primary btn-sm mt-auto">Lihat Barang Keluar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @guest
    <section class="cta py-5">
        <div class="container text-center">
            <h4>Ready to get started?</h2>
            <p>Sign up now and enjoy all the features.</p>
            <a href="{{ route('register') }}" class="btn btn-outline-primary">Sign Up</a>
            <a href="{{ route('login') }}" class="btn btn-primary">Sign In</a>
        </div>
    </section>
    @endguest

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