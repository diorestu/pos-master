@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <form action="{{ route('pengeluaran.update', $data->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="card card-sm rounded-3 mb-3 ">
                    <div class="card-body">
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-4 col-form-label required">Nama Pengeluaran</label>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Nama Pengeluaran" required
                                        name="nama" value="{{ $data->nama }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-4 col-form-label required">Jumlah</label>
                                <div class="col">
                                    <input type="text" class="form-control rupiah" placeholder="Nama Pengeluaran"
                                        required name="jumlah" data-symbol="Rp " data-thousands="." data-decimal=","
                                        value="{{ $data->jumlah }}">
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary rounded-3"><i class="bx bxs-save me-2"></i>Simpan
                                Perubahan</button>
                        </div>
                    </div>
                </div>
            </form>
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
                prefix: 'Rp ',
                precision: 0,
                allowZero: true,
            });
            $('.rupiah').focus()
        });
    </script>
@endsection
