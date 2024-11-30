<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pembelian dan Penjualan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <h3 class="text-center">Laporan Pembelian dan Penjualan</h3>
    <h4 class="text-center">
        Tanggal {{ tanggal_indonesia($awal, false) }}
        s/d
        Tanggal {{ tanggal_indonesia($akhir, false) }}
    </h4>

    <!-- Tabel Pembelian -->
    <h4>Data Pembelian</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Tanggal</th>
                <th>Pembelian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPembelian as $row)
                <tr>
                    <td>{{ $row['DT_RowIndex'] }}</td>
                    <td>{{ $row['tanggal'] }}</td>
                    <td>{{ $row['pembelian'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabel Penjualan -->
    <h4>Data Penjualan</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="15%">No</th>
                <th>Tanggal</th>
                <th>Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPenjualan as $row)
                <tr>
                    <td>{{ $row['DT_RowIndex'] }}</td>
                    <td>{{ $row['tanggal'] }}</td>
                    <td>{{ $row['penjualan'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
