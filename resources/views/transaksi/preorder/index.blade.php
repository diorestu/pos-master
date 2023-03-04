@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-column">
                    <h1 class="mb-0 fw-bold">
                        {{ __('Pre Order') }}
                    </h1>
                    <span class="text-muted">Berdasarkan Tanggal Pesan Terakhir</span>
                </div>
                <!-- Button trigger modal -->
                <a href="{{ route('pesanan.baru') }}" class="btn btn-pink btn-pill">
                    <i class="bx bx-plus me-1"></i>Tambah
                </a>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card shadow-sm rounded-3">
                <div class="card-body p-0">
                    <div class="table-responsive overflow-hidden">
                        <table class="table table-vcenter item_datatables" id="item_datatables">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Pemesan</th>
                                    <th class="text-center">Nomor Telp Pemesan</th>
                                    <th class="text-center">Via Pemesanan</th>
                                    <th class="text-center">Pembayaran Awal</th>
                                    <th class="text-center">Total Bayar</th>
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
                processing: true,
                serverSide: true,
                ajax: "{{ route('preorder.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center',
                        width: '5%',
                    }, {
                        data: 'nama_customer',
                        name: 'nama_customer',
                    },
                    {
                        data: 'phone1',
                        name: 'phone1',
                        width: "15%"
                    },
                    {
                        data: 'via_pemesanan',
                        name: 'via_pemesanan',
                    },
                    {
                        data: 'bayar_dp',
                        name: 'bayar_dp',
                        width: "15%",
                        class: 'text-end'
                    },
                    {
                        data: 'total_bayar',
                        name: 'total_bayar',
                        width: "15%",
                        class: 'text-end'
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
