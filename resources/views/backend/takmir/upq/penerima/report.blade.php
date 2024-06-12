<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        th {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>MASJID AL - ISTIQOMAH</th>
            </tr>
            <tr>
                <th>DAFTAR PENERIMA DAGING QURBAN</th>
            </tr>
            <tr>
                <th>Kelompok: {{ $kelompok }}</th>
            </tr>
            <tr></tr>
            <tr>
                <th>No</th>
                <th>Nama Penerima</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penerima as $item )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>