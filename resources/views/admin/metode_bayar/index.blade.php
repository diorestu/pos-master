@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-column">
                    <h1 class="mb-0">
                        {{ __('Metode Pembayaran') }}
                    </h1>
                    {{-- <span class="text-muted">23 Metode Pembayaran Terbaru</span> --}}
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
                                <h5 class="modal-title">Tambah Metode Pembayaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label class="form-label">Metode Bayar</label>
                                            <input type="text" class="form-control" name="metode">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <textarea class="form-control" name="keterangan" rows="3"></textarea>
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

            {{-- <div class="alert alert-important alert-success alert-dismissible rounded-3" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bx bx-check bx-sm me-2"></i>
                    <h4 class="mb-0">Your account has been saved!</h4>
                </div>
                <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div> --}}

            <div class="card overflow-hidden rounded-3 shadow-sm">

                <div class="table-responsive">
                    <table class="table table-vcenter user_datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="">{{ __('Menu') }}</th>
                                <th class="">{{ __('Nama') }}</th>
                                <th class="">{{ __('Keterangan') }}</th>
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
    <script type="text/javascript">
        $(function() {
            var table = $('.user_datatable').DataTable({
                "lengthMenu": [10, 25, 50, 75, 100],
                "dom": '<"d-flex justify-content-between align-items-center m-3"lf><"my-2"t><"d-flex justify-content-center align-items-center mx-3 mb-2"p>',
                "oLanguage": {
                    "sSearch": "Cari:"
                },
                "language": {
                    "emptyTable": "Data Tidak Tersedia",
                    "paginate": {
                        "previous": '<i class="bx bxs-chevron-left"></i>',
                        "next": '<i class="bx bxs-chevron-right"></i>'
                    }
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('metode-bayar.index') }}",
                columns: [{
                    data: 'action',
                    name: 'action'
                }, {
                    data: 'metode',
                    name: 'metode'
                }, {
                    data: 'keterangan',
                    name: 'keterangan'
                }, ]
            });
        });
    </script>
@endsection
