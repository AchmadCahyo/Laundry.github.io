<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laundry KU</title>
    <style>
        body {
            font-family: sans-serif;
            border: 1px solid;
            border-radius: 10px;
        }

        .title {
            text-align: center;
            font-size: 35px;
            margin-bottom: 20px;
            margin-top: 100px;
        }

        .head {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 40px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="title">
        Bukti Pembayaran Laundry KU
    </div>
    <div class="head">
        @foreach ($outlet as $o)
            <p>Nama Outlet : <b style="color: red;">{{ $o->name }}</b></p>
        @endforeach
        @foreach ($member as $m)
            <p>Nama Kustomer : <b style="color: red;">{{ $m->name }}</b></p>
        @endforeach
        @foreach ($paket as $p)
            <p>Nama Paket : <u>{{ $p->nama_paket }}</u></p>

            <p>Harga : <u>{{ 'Rp. ' . number_format($p->harga, 2, ',', '.') }} / kg</u></p>
        @endforeach
        @foreach ($data as $d)
            <p>Tanggal Terima : <u>{{ $d->tanggal }}</u></p>

            <p>Berat Cucian : <u>{{ $m->jumlah_berat }} kg</u></p>

            <p>Tanggal Selesai : <u>{{ $d->batas_waktu }}</u></p>

            <p>Biaya Tambahan : <u>{{ $d->tanggal_bayar }}</u></p>

            <p>Diskon : <u>{{ 'Rp. ' . number_format($d->diskon, 2, ',', '.') }}</u></p>

            <p>pajak : <u>{{ 'Rp. ' . number_format($d->pajak, 2, ',', '.') }}</u></p>

            <p>Status : <u>{{ $d->status }}</u></p>

            <p>Status Pembayaran : <u>{{ $d->dibayar }}</u></p>
        @endforeach
        <p>Pembuat Laporan : <u>{{ Auth::user()->name }}</u></p>

        {{-- <p>Biaya Yang Dibayar : {{ $totalHarga }}</p> --}}
    </div>
    <div style="text-align: center">
        <p>Selamat Menikmati Cucian Bersih Anda Dan Jangan Lupa Kembali Lagi</p>
        <br>
        <br>
        <p>Tertanda Laundry KU</p>
    </div>
</body>

</html>
