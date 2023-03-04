@extends('layouts.app')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <form method="post" action="{{ route('report.print') }}" target="_blank">
                    <div class="card-body">
                        <h4 class="mb-3 text-reset">Cetak Laporan General</h4>
                        @csrf
                        <input id="tanggal" class="form-control input-range" type="text" name="tanggal">
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit"><i class="bx bxs-printer me-2"></i>Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        $(function() {
            $('.input-range').daterangepicker({
                minDate: new Date(2022, 1 - 1, 1),
                maxDate: new Date(2040, 0 - 0, 0),
                locale: {
                    format: 'YYYY/MM/DD'
                }
            })
        })
    </script>
@endsection
