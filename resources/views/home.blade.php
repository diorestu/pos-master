@extends('layouts.app')

@section('custom_styles')
@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck">
                <div class="col-6 d-flex flex-column">
                    <div class="card rounded-3 shadow-sm mb-3">
                        <div class="card-body rounded-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h3 class="">Pemasukan Hari Ini</h3>
                                    <a class="display-6 fw-bold text-green text-decoration-none cursor-pointer">Rp.
                                        {{ number_format($in) }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-3 shadow-sm">
                        <div class="card-body rounded-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <h3 class="fw-bold text-pink">Pengeluaran Hari Ini</h3>
                                    <a class="display-6 fw-bolder text-pink text-decoration-none cursor-pointer">Rp.
                                        {{ number_format($out) }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card shadow-sm rounded-3">
                        <div class="card-body">
                            {!! $chart->container() !!}
                            <script src="{!! $chart->cdn() !!}"></script>
                            {{ $chart->script() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- <div class="container-xl">
            <div class="hr-text">Akses Menu</div>
            <div class="container-xl">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <div class="card rounded-3 shadow">
                            <div class="card-body rounded-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h2 class="fw-bold"><strong>Pre Order</strong></h2>
                                        <a href="{{ route('pesanan.baru') }}"
                                            class="btn btn-sm btn-pill btn-indigo text-decoration-none cursor-pointer">Buat
                                            Baru</a>
                                    </div>
                                    <i class="bx bx-cart text-indigo bx-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <div class="card rounded-3 shadow">
                            <div class="card-body rounded-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h2 class="fw-bold"><strong>Penjualan</strong></h2>
                                        <a
                                            class="btn btn-sm btn-pill btn-green text-decoration-none cursor-pointer">Masuk</a>
                                    </div>
                                    <i class="bx bx-cart text-green bx-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <div class="card rounded-3 shadow">
                            <div class="card-body rounded-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h2 class="fw-bold"><strong>Pembelian</strong></h2>
                                        <a
                                            class="btn btn-sm btn-pill btn-blue text-decoration-none cursor-pointer">Masuk</a>
                                    </div>
                                    <i class="bx bx-cart-add text-blue bx-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <div class="card rounded-3 shadow">
                            <div class="card-body rounded-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h2 class="fw-bold"><strong>Stok</strong></h2>
                                        <a
                                            class="btn btn-sm btn-pill btn-pink text-decoration-none cursor-pointer">Masuk</a>
                                    </div>
                                    <i class="bx bx-package text-pink bx-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                        <div class="card rounded-3 shadow">
                            <div class="card-body rounded-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h2 class="fw-bold"><strong>Pengeluaran</strong></h2>
                                        <a
                                            class="btn btn-sm btn-pill btn-orange text-decoration-none cursor-pointer">Masuk</a>
                                    </div>
                                    <i class="bx bx-wallet text-orange bx-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
@endsection
