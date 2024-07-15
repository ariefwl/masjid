<!DOCTYPE html>
<html>
<head>
    <title>Kas Qurban :: Al - Istiqomah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        .report-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .no-border {
            border: none;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="report-container">
        <h3>Laporan Kas</h3>
        <h3>Idul Adha 1.444 H.</h3>
        <h3>Periode : {{ $tgl_awal }} s/d {{ $tgl_akhir }}</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No.</th>
                    <th style="width: 10%;">Tanggal</th>
                    <th style="width: 50%;">Keterangan</th>
                    <th style="width: 10%;">Masuk</th>
                    <th style="width: 10%;">Keluar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="text-right"><strong>Saldo Awal :</strong></td>
                    <td class="text-right">{{ number_format($sawal, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5" class="no-border"><strong>Pemasukan :</strong></td>
                </tr>
                @foreach ($masuk as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td class="text-right">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="no-border"><strong>Pengeluaran :</strong></td>
                </tr>
                @foreach ($keluar as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td></td>
                        <td class="text-right">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-right"><strong>Total :</strong></td>
                    <td class="text-right">{{ number_format($totalMasuk, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($totalKeluar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right"><strong>Saldo Akhir :</strong></td>
                    <td colspan="2" class="text-right">{{ number_format($saldoAkhir, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
