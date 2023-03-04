@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-column">
                    <h1 class="mb-0">
                        {{ __('Data Pengguna') }}
                    </h1>
                    {{-- <span class="text-muted">23 Data Pengguna Terbaru</span> --}}
                </div>
                <!-- Button trigger modal -->
                {{-- <button type="button" class="btn btn-pink btn-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bx bx-plus me-1"></i>Tambah
                </button> --}}

                <!-- Modal -->
                {{-- <div class="modal fade" tabindex="-1" class="modal fade" id="exampleModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Data Pengguna</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">NIK</label>
                                                <input type="text" class="form-control" name="nik" placeholder="NIK">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="nama"
                                                    placeholder="Nama Lengkap">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control" name="tempat_lahir"
                                                    placeholder="Tempat Lahir">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control" name="tgl_lahir"
                                                    placeholder="Tanggal Lahir">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Kelamin</label>
                                                <select name="gender" id="" class="form-control form-select">
                                                    <option value="Pria">Pria</option>
                                                    <option value="Wanita">Wanita</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nomor HP</label>
                                                <input type="text" class="form-control" name="telp"
                                                    placeholder="Nomor HP">
                                            </div>
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
                </div> --}}
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
                                <th class="">{{ __('Menu') }}</th>
                                <th class="">{{ __('Nama') }}</th>
                                <th class="">{{ __('Nama Pengguna') }}</th>
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
                "dom": '<"d-flex justify-content-between align-items-center mx-3 my-3"lf><"my-2"t><"d-flex justify-content-center align-items-center mx-3 mb-2"p>',
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
                ajax: "{{ route('users.index') }}",
                columns: [{
                    data: 'action',
                    name: 'action'
                }, {
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'username',
                    name: 'username'
                }, ]
            });
        });
    </script>
@endsection
