@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-column">
                    <h1 class="mb-0">
                        {{ __('Stok Awal') }}
                    </h1>
                    {{-- <span class="text-muted">23 Data Pengguna Terbaru</span> --}}
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-pink btn-pill {{ $stok->count() > 1 ? 'd-none' : '' }}"
                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bx bx-plus me-1"></i>Input Stok Hari Ini
                </button>

                <!-- Modal -->
                <div class="modal fade" tabindex="-1" class="modal fade" id="exampleModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Set Stok Awal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    @foreach ($data as $item)
                                        <div class="mb-3 row">
                                            <label class="col-8 col-form-label fw-bold">{{ $item->nama_produk }}</label>
                                            <div class="col">
                                                <input type="hidden" name="id_produk[]" value="{{ $item->id }}" />
                                                <input type="number" class="form-control" name="qty_stok[]" />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary w-100" data-bs-dismiss="modal">
                                        Submit Data
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card overflow-hidden rounded-3 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-vcenter user_datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">{{ __('#') }}</th>
                                <th class="text-center" width="20%">{{ __('Tanggal') }}</th>
                                <th>{{ __('Nama') }}</th>
                                <th class="text-center" width="20%">{{ __('Harga') }}</th>
                                <th class="text-center">{{ __('Jumlah') }}</th>
                                <th class="text-center" width="5%">{{ __('Menu') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stok as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ tglIndo($item->tgl_stok) }}</td>
                                    <td>{{ $item->produk->nama_produk }}</td>
                                    <td class="text-center">Rp {{ number_format($item->produk->harga_produk) }}</td>
                                    <td class="text-center">{{ number_format($item->qty_stok) }}</td>
                                    <td>
                                        <a class="btn btn-pink btn-sm btn-pill" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $item->id }}">Ubah Stok</a>
                                        <!-- Modal -->
                                        <div class="modal fade" tabindex="-1" class="modal fade"
                                            id="modalEdit{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Ubah Stok Awal</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('stok.update', $item->id) }}" method="post"
                                                        id="formEdit">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-body">
                                                            <div class="mb-3 row">
                                                                <label
                                                                    class="col-8 col-form-label fw-bold">{{ $item->produk->nama_produk }}</label>
                                                                <div class="col">
                                                                    <input type="hidden" name="id_produk"
                                                                        value="{{ $item->id }}" />
                                                                    <input type="number" class="form-control"
                                                                        name="qty_stok" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary w-100"
                                                                data-bs-dismiss="modal">
                                                                Ubah Data
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
