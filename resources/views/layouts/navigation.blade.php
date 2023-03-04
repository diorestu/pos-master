<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item @if (request()->routeIs('home')) active @endif">
                        <a class="nav-link" href="{{ route('home') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class='bx bxs-dashboard text-red'></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Dashboard') }}
                            </span>
                        </a>
                    </li>
                    @role('admin')
                        <li class="nav-item dropdown @if (request()->is('master/*')) active @endif">
                            <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class='bx bxs-package text-red'></i>
                                </span>
                                <span class="nav-link-title">
                                    Master
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item @if (request()->is('master/produk*')) active @endif"
                                    href="{{ route('produk.index') }}">
                                    Produk
                                </a>
                                <a class="dropdown-item @if (request()->is('master/metode*')) active @endif"
                                    href="{{ route('metode-bayar.index') }}">
                                    Metode Pembayaran
                                </a>
                            </div>
                        </li>
                    @endrole
                    <li class="nav-item dropdown @if (request()->is('transaksi/preorder*')) active @endif">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class='bx bxs-send text-red'></i>
                            </span>
                            <span class="nav-link-title">
                                Pemesanan (PO)
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('pesanan.baru') }}">
                                Input Pesanan
                            </a>
                            <a class="dropdown-item" href="{{ route('preorder.index') }}">
                                Riwayat Pesanan
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown @if (request()->is('transaksi/penjualan*')) active @endif">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class='bx bxs-cart-alt text-red'></i>
                            </span>
                            <span class="nav-link-title">
                                Penjualan
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('penjualan.baru') }}">
                                Input Penjualan
                            </a>
                            <a class="dropdown-item" href="{{ route('penjualan.index') }}">
                                Riwayat Penjualan
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown @if (request()->is('transaksi/pengeluaran*')) active @endif">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class='bx bxs-cart-alt text-red'></i>
                            </span>
                            <span class="nav-link-title">
                                Pengeluaran
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item @if (request()->is('master/metode*')) active @endif"
                                href="{{ route('saldo.index') }}">
                                Saldo Awal
                            </a>
                            <a class="dropdown-item" href="{{ route('pengeluaran.index') }}">
                                Pengeluaran
                            </a>
                        </div>
                    </li>
                    <li class="nav-item @if (request()->is('transaksi/stok*')) active @endif">
                        <a class="nav-link" href="{{ route('stok.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class='bx bxs-box text-red'></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Stok') }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown @if (request()->is('laporan*')) active @endif">
                        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class='bx bxs-cart-alt text-red'></i>
                            </span>
                            <span class="nav-link-title">
                                Laporan
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item @if (request()->is('report/harian*')) active @endif"
                                onclick="createPopupWin('{{ route('report.harian') }}',
                                'Laporan General Hari Ini', 810, 540);">
                                Laporan General Hari Ini
                            </a>
                            <a class="dropdown-item @if (request()->is('report/bulanan*')) active @endif"
                                onclick="createPopupWin('{{ route('report.bulanan') }}',
                                'Laporan General Bulan Ini', 810, 540);">
                                Laporan General Bulan Ini
                            </a>

                            <a class="dropdown-item" href="{{ route('report.view') }}">
                                Laporan General
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
