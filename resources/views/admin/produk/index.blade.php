@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-column">
                    <h1 class="mb-0">
                        {{ __('Produk') }}
                    </h1>

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
                                <h5 class="modal-title">Tambah Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('produk.store') }}" method="post">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    <div class="mb-3 row">
                                        <label class="col-4 col-form-label">Nama Produk</label>
                                        <div class="col">
                                            <input type="text" class="form-control" name="nama_produk">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-4 col-form-label">Harga Produk</label>
                                        <div class="col">
                                            <input type="number" class="form-control" name="harga_produk">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-4 col-form-label">Keterangan</label>
                                        <div class="col">
                                            <textarea class="form-control" rows="3" name="keterangan"></textarea>
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
                    <table class="table table-vcenter table-hover user_datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('Menu') }}</th>
                                <th class="">{{ __('Nama') }}</th>
                                <th class="">{{ __('Harga') }}</th>
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
                "lengthMenu": [25, 50, 75, 100],
                "dom": '<"d-flex justify-content-between align-items-center m-3"lf><"my-2"t><"d-flex justify-content-center align-items-center mx-3 mb-2"p>',
                "oLanguage": {
                    "sSearch": "Cari:"
                },
                "language": {
                    "emptyTable": "Data Tidak Tersedia",
                    "paginate": {
                        "previous": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="11 7 6 12 11 17"></polyline><polyline points="17 7 12 12 17 17"></polyline></svg>',
                        "next": '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevrons-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="7 7 12 12 7 17"></polyline><polyline points="13 7 18 12 13 17"></polyline></svg>'
                    }
                },
                processing: true,
                serverSide: true,
                order: [
                    [1, 'asc']
                ],
                ajax: "{{ route('produk.index') }}",
                columns: [{
                    data: 'modal-edit',
                    name: 'modal-edit',
                    orderable: false,
                    searchable: false,
                    width: '5%'
                }, {
                    data: 'nama_produk',
                    name: 'nama_produk'
                }, {
                    data: 'harga',
                    name: 'harga',
                    width: '12%',
                }, {
                    data: 'keterangan',
                    name: 'keterangan',
                    width: '35%',
                }]
            });
        });
    </script>
@endsection
