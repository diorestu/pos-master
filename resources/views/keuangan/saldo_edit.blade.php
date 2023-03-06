@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-column">
                    <h1 class="mb-0">
                        {{ __('Ubah Saldo Awal') }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card overflow-hidden rounded-3 shadow-sm">
                <form action="{{ route('saldo.update', $data->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-8 col-form-label fw-bold">Nilai Saldo Awal</label>
                            <div class="col">
                                <input type="text" class="form-control rupiah" name="saldo_awal"
                                    value="{{ $data->saldo_awal }}" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary w-100" data-bs-dismiss="modal">
                            Submit Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/jquery.maskMoney.min.js') }}"></script>
    <script type="text/javascript">
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
@endsection
