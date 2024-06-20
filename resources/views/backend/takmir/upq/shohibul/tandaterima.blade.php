<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tanda Terima</title>
    <style>
        body {
            background: rgb(255, 255, 255);
            width: 21cm;
            height: 29.7cm;
            height: 
            /* margin: 30px; */
        }
        .page[size="A4"]{
            /* background: white; */
            width: 21cm;
            height: 29.7cm;
            display: block;
            /* margin: 0 auto; */
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }
        @media print {
            body, page[size="A4"] {
                margin: 0;
                box-shadow: 0;
            }
        }
        .logo img{
            max-height: 80px;
        }
        .masjid {
            text-align: right;
        }
        .masjid h2 {
            margin: 0;
            line-height: 0px;
            font-size: 18px;
            font-weight: bold;
        }
        .masjid p {
            font-size: 12px;
        }
        header {
            /* padding: 0px; */
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0cm;
            /* background-color: yellow; */
        }
        hr {
            margin: 0cm;
        }
        judul h3 {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-weight: bold;
            font-size: 14pt;
            text-align: center;
        }
        table {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>
<body>
    <page size="A4">
        @foreach ($shohibul as $item)
            <header>
                <div class="logo">
                    <img src="{{ asset('Image/logo.png') }}" alt="logo" srcset="">
                </div>
                <div class="masjid">
                    <h2>PANITIA QURBAN MASJID AL - ISTIQOMAH</h2>
                    <p>Jl. Jati Raya No. 1 Banyumanik - Semarang</p>
                </div>
            </header>
            <hr>
            <judul>
                <h3>Tanda Terima Daging Qurban</h3>
            </judul>
        
            <table>
                <tr>
                    <td>Telah terima dari</td>
                    <td>:</td>
                    <td>Panitia Qurban Masjid Al - Istiqomah</td>
                </tr>
                <tr>
                    <td>Untuk</td>
                    <td>:</td>
                    <td>{{ $item->nama }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $item->alamat }}</td>
                </tr>
                <tr>
                    <td>Qurban / Kategori</td>
                    <td>:</td>
                    <td>{{ $item->nama_hewan }}</td>
                </tr>
                <tr>
                    <td>Keterangan</td>
                    <td>:</td>
                    <td>{{ $item->permintaan }}</td>
                </tr>
            </table>
                
            <p>Semarang, 10 Juni 2024</p>
            <table>
                <tr>
                    <td style="width: 400px;">Pengirim</td>
                    <td>Penerima</td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td style="width: 400px;">...................</td>
                    <td>...................</td>
                </tr>
            </table>
        @endforeach
    </page>


</body>
</html>