<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;600&display=swap" rel="stylesheet">

    <style>
        @page {
            margin: 20px 30px 15px 30px;
            font-family: 'Roboto', sans-serif !important;
            font-size: 11pt;
        }

        .text-header {
            font-weight: bold;
            text-decoration: underline;
            text-align: center !important;
            margin-bottom: 0;
            padding-bottom: 0;
            font-size: 14pt;
        }

        .text-subheader {
            text-align: center !important;
            margin-top: 0;
            margin-bottom: 0;
        }

        .text-center {
            text-align: center !important;
        }

        .text-left {
            text-align: left !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-justify {
            text-align: justify !important;
        }

        .ms-2 {
            margin-left: 1.25cm !important;
        }

        .ms-3 {
            margin-left: 2cm !important;
        }

        .me-2 {
            margin-left: 1.25cm !important;
        }

        .me-3 {
            margin-left: 2cm !important;
        }

        h2 {
            font-size: 18px;
            margin-bottom: .15px;
        }

        h3 {
            font-size: 14px;
            margin-top: 5px !important;
            margin-bottom: 5px !important;
        }

        h4 {
            font-size: 11.5px;
            margin: 1px;
        }

        h5 {
            font-weight: 400;
            font-size: 11px;
            margin-bottom: 2px;
        }

        h6 {
            font-size: 10px;
            font-weight: 300;
            margin: 0px;
        }

        small {
            font-size: 9px;
            margin: 0px;
        }

        p {
            font-size: 10px;
            padding: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        b {
            font-size: 9.75px;
            padding: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        table,
        tr,
        td {
            vertical-align: middle;
            margin-bottom: 4px;
        }

        .table {
            width: 100%;
            color: #03071e;
            background-color: transparent;
            border-collapse: collapse;
            border: 0px;
        }

        .table th {
            font-weight: bold;
        }

        .table th,
        .table td {
            font-size: 10pt;
            padding: 0px;
            vertical-align: center;
        }

        .table-bordered {
            border: 1px solid #03071e;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #03071e;
        }

        td.right {
            text-align: right;
            padding-right: 25px;
        }

        tr.spaceUnder>td {
            padding-bottom: 3em;
        }

        .page-break {
            page-break-after: always;
        }
    </style>


</head>

<body>
    <h2 class="mb-0">{{ strtoupper($title) }}</h2>
    <h4 class="mb-0" style="margin-bottom: 0 !important;">PIA LEGONG BALI</h4>
    <h6 class="text-reset mb-3">{{ tanggal_indonesia($date) }}</h6>
    <h5 class="mb-0">Rekap Transaksi Berdasarkan Metode Pembayaran</h5>
    <table class="table table-sm table-bordered">
        <thead style="background-color: #ced4da; color: #333;">
            <tr>
                <th class="text-center" width="40">No.</th>
                <th class="text-center">Metode Pembayaran</th>
                <th class="text-center" width="100">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1</td>
                <td class="text-center">Saldo Awal</td>
                <td class="text-right">{{ number_format($awal->saldo_awal) }}</td>
            </tr>
            @forelse ($payment as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration + 1 }}</td>
                    <td class="text-center">{{ $item->metode }}</td>
                    <td class="text-right">{{ number_format($item->total) }}</td>
                </tr>
            @empty
            @endforelse
            <tr>
                <td colspan="2" class="text-right" style="vertical-align: middle !important">
                    <h3 style="">GRAND
                        TOTAL&nbsp;&nbsp;&nbsp;</h3>
                </td>
                <td colspan="1" class="text-right" style="vertical-align: middle !important">
                    <h3>{{ number_format($payment->sum('total') + $awal->saldo_awal) }}</h3>
                </td>
            </tr>
        </tbody>
    </table>
    <h5 class="mt-3 mb-1">Rekap Pengeluaran</h5>
    <table class="table table-sm table-bordered">
        <thead style="background-color: #ced4da; color: #333;">
            <tr>
                <th class="text-center" width="40">No.</th>
                <th class="text-center">Waktu</th>
                <th class="text-center" width="">Keterangan</th>
                <th class="text-center" width="100">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($out as $item)
                <tr>
                    <td class="text-center" width="5%">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ waktuIndo($item->created_at) }} WITA</td>
                    <td class="text-center">{{ $item->nama }}</td>
                    <td class="text-right">{{ number_format($item->jumlah) }}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="4">Tidak Ada Data Tersedia</td>
                </tr>
            @endforelse
            <tr>
                <td colspan="3" class="text-right" style="vertical-align: middle !important">
                    <h3 style="">GRAND
                        TOTAL&nbsp;&nbsp;&nbsp;</h3>
                </td>
                <td colspan="1" class="text-right" style="vertical-align: middle !important">
                    <h3>{{ number_format($out->sum('jumlah')) }}</h3>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
