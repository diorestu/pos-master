@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 mb-3">
                    <table>
                        <tbody>
                            <tr>
                                <th width="35%">Tanggal</th>
                                <td width="10%">:</td>
                                <td width="55%">{{ tglIndo(now()) }}</td>
                            </tr>
                            <tr>
                                <th>ID Transaksi</th>
                                <td>:</td>
                                <td>{{ $pesanan->kode_penjualan }}</td>
                            </tr>
                            <tr>
                                <th>Kasir</th>
                                <td>:</td>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card mb-3 rounded-3 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="display-4 fw-bold">Rp</span>
                                <h5 class="display-4 fw-bolder text-end total text-primary mb-0" id="total"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 rounded-3 shadow-sm">
                        <div class="card-body px-0">
                            <div class="d-flex justify-content-end mx-3 mb-3">
                                <button type="button" class="btn btn-outline-primary btn-pill btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="bx bx-search me-1"></i> Pilih Produk
                                </button>
                                @includeIf('transaksi.penjualan.dataProduk')
                            </div>
                            <div class="table-responsive overflow-hidden">
                                <table class="table table-vcenter item_datatables" id="item_datatables">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Subtotal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-4">
                    <form action="{{ route('penjualan.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="id_penjualan" value="{{ $pesanan->id }}">
                        <div class="card mb-3 rounded-3 shadow-sm">
                            <div class="card-body pb-0">
                                <div class="mb-3 row">
                                    <label class="col-5 col-form-label required">Metode Bayar</label>
                                    <div class="col">
                                        <select name="metode_bayar[]" id="metode_bayar">
                                            <option selected disabled>Pilih Salah Satu</option>
                                            @foreach ($metode as $item)
                                                <option value="{{ $item->id }}">{{ $item->metode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-5 col-form-label required">Total Bayar</label>
                                    <div class="col">
                                        <input type="text" id="inputTotal" class="rupiah form-control total" required
                                            name="total[]" data-symbol="Rp " data-thousands="." data-decimal=",">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3 rounded-3 shadow-sm">
                            <div class="card-body pb-0">
                                <div class="mb-3 row">
                                    <label class="col-5 col-form-label required">Metode Bayar</label>
                                    <div class="col">
                                        <select name="metode_bayar[]" id="metode_bayar2">
                                            <option selected disabled>Pilih Salah Satu</option>
                                            @foreach ($metode as $item)
                                                <option value="{{ $item->id }}">{{ $item->metode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-5 col-form-label required">Total Bayar</label>
                                    <div class="col">
                                        <input type="text" id="inputTotal" class="rupiah form-control" name="total[]"
                                            data-symbol="Rp " data-thousands="." data-decimal=",">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary w-100">Submit Transaksi <i
                                class="bx bxs-send ms-2 bx-xs"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/plug-ins/1.13.2/api/sum().js"></script>
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
            var table = $('.item_datatables').DataTable({
                "drawCallback": function(settings) {
                    var total = Intl.NumberFormat('id-ID').format(table.column(4).data().sum());
                    $('.total').text(total);
                    $('#inputTotal').val(table.column(4).data().sum());
                    $('#inputTotal').maskMoney('mask');
                },
                "dom": '<"d-flex justify-content-between align-items-center m-3"lf><"my-0"t><"d-flex justify-content-center align-items-center mx-3 mb-0"p>',
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
                ajax: "{{ route('item-penjualan.data', $pesanan->id) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'text-center',
                        width: '5%',
                    }, {
                        data: 'title',
                        name: 'title',
                        width: '45%',
                    },
                    {
                        data: 'qty',
                        name: 'qty',
                        width: "15%"
                    },
                    {
                        data: 'harga',
                        name: 'harga',
                        class: 'text-end',
                        width: '15%',
                    },
                    {
                        data: 'subtotal',
                        name: 'subtotal',
                        class: 'text-end',
                        width: "15%"
                    },
                    {
                        data: 'action',
                        name: 'action',
                        class: 'text-center',
                        width: '5%',
                    },
                ]
            });

            function formatRupiah(angka) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return rupiah ? rupiah : '';
            }

            $(document).on('change', '.quantity', function() {
                let id = $(this).data('id');
                let jumlah = parseInt($(this).val());
                if (jumlah < 1) {
                    $(this).val(1);
                    $(this).focus();

                    Toastify({
                        text: 'Jumlah tidak boleh kurang dari 1',
                        duration: 2400,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "#e63946",
                        },
                    }).showToast();
                    return;
                }
                if (jumlah > 9999) {
                    $(this).val(9999);
                    Toastify({
                        text: "Jumlah melebihi batas maksimal",
                        duration: 2400,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "#e63946",
                        },
                    }).showToast();
                    $(this).focus();
                    return;
                }
                var url = "{{ route('item-penjualan.update', ':id') }}";
                url = url.replace(':id', id);
                setTimeout(function() {
                    $.post(url, {
                            '_token': $('[name=csrf-token]').attr('content'),
                            '_method': 'PATCH',
                            'qty': jumlah
                        })
                        .done(response => {
                            table.draw();
                        })
                        .fail(errors => {
                            $(this).val(1);
                            alert('Jumlah item tidak boleh kosong');
                            return;
                        })
                }, 500);
            });

            $(document).on('click', '.btndel', function() {
                let id = $(this).data('id');
                var url = "{{ route('item-penjualan.destroy', ':id') }}";
                url = url.replace(':id', id);
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'DELETE',
                    })
                    .done(response => {
                        Toastify({
                            text: response.success,
                            duration: 2400,
                            gravity: "bottom",
                            position: "right",
                            stopOnFocus: true,
                            style: {
                                background: "linear-gradient(to right, #80b918, #55a630)",
                            },
                        }).showToast();
                        table.draw();
                    })
                    .fail(errors => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    })
            });

            var form = '.pilih-produk';
            $(form).on('submit', function(event) {
                event.preventDefault();
                var url = $(this).attr('data-action');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            Toastify({
                                text: response.success,
                                duration: 2400,
                                gravity: "bottom",
                                position: "right",
                                stopOnFocus: true,
                                style: {
                                    background: "linear-gradient(to right, #80b918, #55a630)",
                                },
                            }).showToast();
                        } else {
                            Toastify({
                                text: 'Item sudah diinput!',
                                duration: 2400,
                                gravity: "bottom",
                                position: "right",
                                stopOnFocus: true,
                                style: {
                                    background: "#e63946",
                                },
                            }).showToast();
                        }
                        $('#exampleModal').modal('toggle');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        alert(response);
                        Toastify({
                            text: response.error,
                            duration: 2400,
                            gravity: "bottom",
                            position: "right",
                            stopOnFocus: true,
                            style: {
                                background: "#e63946",
                            },
                        }).showToast();
                    }
                });
            });
        });
    </script>
    <script>
        new TomSelect("#metode_bayar", {
            create: true,
        });
        new TomSelect("#metode_bayar2", {
            create: true,
        });
    </script>
@endsection
