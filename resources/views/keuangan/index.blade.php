@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-column">
                    <h1 class="mb-0">
                        {{ __('Pengeluaran') }}
                    </h1>
                    {{-- <span class="text-muted">23 SDM Terbaru</span> --}}
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-pink btn-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bx bx-plus me-1"></i>Tambah
                </button>

                <!-- Modal -->
                <div class="modal fade" tabindex="-1" class="modal fade" id="exampleModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Input Pengeluaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Pengeluaran</label>
                                            <input type="text" class="form-control" name="nama">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jumlah</label>
                                            <input type="text" class="form-control rupiah" name="jumlah"
                                                placeholder="Jumlah" data-symbol="Rp " data-thousands="." data-decimal=",">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
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
                    <table class="table table-vcenter table-bordered item_datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="">{{ __('Menu') }}</th>
                                <th class="">{{ __('Nama') }}</th>
                                <th class="">{{ __('Tanggal') }}</th>
                                <th class="">{{ __('Keterangan') }}</th>
                                <th class="">{{ __('Jumlah') }}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('build/jquery.maskMoney.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.rupiah').maskMoney({
                thousands: '.',
                decimal: ',',
                allowZero: true,
                prefix: 'Rp ',
                precision: 0,
                allowZero: true
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            var table = $('.item_datatable').DataTable({
                "lengthMenu": [25, 50, 75, 100],
                "dom": '<"d-flex justify-content-between align-items-center mx-3 my-3"lf><"my-2"t><"d-flex justify-content-center align-items-center mx-3 mb-2"p>',
                "oLanguage": {
                    "sSearch": "Cari:"
                },
                order: [
                    [1, 'asc']
                ],
                "language": {
                    "emptyTable": "Data Tidak Tersedia",
                    "paginate": {
                        "previous": '<i class="bx bx-sm bx-chevron-left"></i>',
                        "next": '<i class="bx bx-sm bx-chevron-right"></i>'
                    }
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengeluaran.index') }}",
                columns: [{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    class: 'text-center',
                    width: '10%',
                }, {
                    data: 'user',
                    name: 'user'
                }, {
                    data: 'tgl_keluar',
                    name: 'tgl_keluar'
                }, {
                    data: 'nama',
                    name: 'nama'
                }, {
                    data: 'jumlah',
                    name: 'jumlah'
                }, ]
            });
        });
    </script>
@endsection
