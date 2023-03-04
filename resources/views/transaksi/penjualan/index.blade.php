@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-column">
                    <h1 class="mb-0 fw-bold">
                        {{ __('Penjualan') }}
                    </h1>
                    <span class="text-muted">Berdasarkan Tanggal Pesan Terakhir</span>
                </div>
                <!-- Button trigger modal -->
                <a href="{{ route('penjualan.baru') }}" class="btn btn-pink btn-pill">
                    <i class="bx bx-plus me-1"></i>Buat Transaksi Baru
                </a>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card shadow-sm rounded-3">
                <div class="card-body p-0">
                    <div class="table-responsive overflow-hidden">
                        <table class="table table-vcenter table-bordered item_datatables" id="item_datatables">
                            <thead>
                                <tr>
                                    <th class="text-center">No. Nota</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Item</th>
                                    <th class="text-center">Pembayaran</th>
                                    <th class="text-center" width="10%">Total</th>
                                    <th class="text-center" width="10%">Diskon</th>
                                    <th class="text-center" width="10%">Grand Total</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            var table = $('.item_datatables').DataTable({
                "dom": '<"d-flex justify-content-between align-items-center mx-3 my-3"lf><"my-0"t><"d-flex justify-content-end align-items-center mx-3 mb-0"p>',
                "oLanguage": {
                    "sSearch": "Cari:"
                },
                "language": {
                    "emptyTable": "Data Tidak Tersedia",
                    "paginate": {
                        "previous": '<i class="bx bx-sm bx-chevron-left"></i>',
                        "next": '<i class="bx bx-sm bx-chevron-right"></i>'
                    }
                },
                order: [
                    [1, 'asc']
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('penjualan.index') }}",
                columns: [{
                        data: 'kode_penjualan',
                        name: 'kode_penjualan',
                        class: 'text-center',
                        orderable: false,
                        width: '10%',
                    }, {
                        data: 'tgl_jual',
                        name: 'tgl_jual',
                        class: 'text-center',
                    }, {
                        data: 'items',
                        name: 'items',
                        class: 'text-start',
                    }, {
                        data: 'payment',
                        name: 'payment',
                        class: 'text-start',
                    }, {
                        data: 'total',
                        name: 'total',
                        class: 'text-end',
                    }, {
                        data: 'diskon',
                        name: 'diskon',
                        class: 'text-end',
                    }, {
                        data: 'grand_total',
                        name: 'grand_total',
                        class: 'text-end',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        class: 'text-center',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                    },
                ]
            });
        });
    </script>
@endsection
