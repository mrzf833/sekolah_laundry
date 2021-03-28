<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: 'Lato';font-size: 22px;
        }
        .page-a4-landscape{
            width: 28.7cm;
            height: 19cm;
            margin-left: auto;
            margin-right: auto;
        }
        h1{
            font-size: 30px;
        }
        p{
            font-size: 20px;
        }
        table{
            width: 100%;
            margin-top: 5px;
        }
        .table-header td{
            width: 25%;
            vertical-align:top
        }
        .table-detail{
            margin-top: 20px;
            border: 1px solid black;
            border-collapse: collapse
        }
        .table-detail th{
            border: thin solid black
        }
        .table-detail td{
            border-right: thin solid black
        }
        .content-td{
            padding-left: 10px;
        }
    </style>
</head>
<body>
    <div class="page-a4-landscape">
        <center><h1>LAUNDRY INVOICE</h1></center>
        <table class="table-header">
            <tbody>
                <tr>
                    <td>Member</td>
                    <td>: {{ $transaksi->members->nama }}</td>
                    <td>Kode Invoice</td>
                    <td>: {{ $transaksi->kode_invoice }}</td>
                </tr>
                <tr>
                    <td>Outlet</td>
                    <td>: {{ $transaksi->outlets->nama}}</td>
                    <td>Tanggal</td>
                    <td>: {{ $transaksi->tgl }}</td>
                </tr>
                <tr>
                    <td>Batas Waktu</td>
                    <td>: {{ $transaksi->batas_waktu }}</td>
                    <td>Tanggal Bayar</td>
                    <td>: {{ $transaksi->tgl_bayar }}</td>
                </tr>
                <tr>
                    <td>Biaya Tambahan</td>
                    <td>: {{ $transaksi->biaya_tambahan }}</td>
                    <td>Diskon</td>
                    <td>: {{ $transaksi->diskon }}%</td>
                </tr>
                <tr>
                    <td>Pajak</td>
                    <td>: {{ $transaksi->pajak }}</td>
                    <td>Dibayar</td>
                    <td>: {{ $transaksi->dibayar }}</td>
                </tr>
                <tr>
                    <td>Alamat Member</td>
                    <td>: {{ $transaksi->members->alamat }}</td>
                    <td>Status</td>
                    <td>: {{ $transaksi->status }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table-detail">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($detail_transaksis as $detail_transaksi)
                    <tr>
                        <td><p class="content-td">{{ $no++ }}</p></td>
                        <td><p class="content-td">{{ $detail_transaksi->pakets->nama_paket }}</p></td>
                        <td><p class="content-td">{{ $detail_transaksi->pakets->jenis }}</p></td>
                        <td><p class="content-td">{{ number_format($detail_transaksi->pakets->harga, 2, ',', '.') }}</p></td>
                        <td><p class="content-td">{{ $detail_transaksi->qty }}</p></td>
                        <td><p class="content-td">{{ number_format($detail_transaksi->qty * $detail_transaksi->pakets->harga, 2, ',', '.') }}</p></td>
                    </tr>
                @empty
                    
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p class="content-td"><b>Sub Total</b></p></td>
                    <td><p class="content-td"><b>{{ number_format($semua_paket, 2 , ',', '.') }}</b></p></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p class="content-td"><b>Diskon</b></p></td>
                    <td><p class="content-td"><b>{{ number_format(($transaksi->diskon / 100) * $semua_paket, 2, ',', '.') }}</b></p></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p class="content-td"><b>Pajak</b></p></td>
                    <td><p class="content-td"><b>{{ number_format($transaksi->pajak, 2, ',', '.') }}</b></p></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p class="content-td"><b>Biaya Tambahan</b></p></td>
                    <td><p class="content-td"><b>{{ number_format($transaksi->biaya_tambahan, 2, ',', '.') }}</b></p></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><p class="content-td"><b>Total</b></p></td>
                    <td><p class="content-td"><b>{{ number_format(($semua_paket - (($transaksi->diskon / 100) * $semua_paket) + $transaksi->pajak + $transaksi->biaya_tambahan), 2, ',', '.') }}</b></p></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <script>
        window.print()
    </script>
</body>
</html>