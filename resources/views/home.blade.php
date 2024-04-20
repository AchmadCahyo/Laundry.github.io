@extends('layouts.main')

@section('content')
    <div class="container" style="background-color: #C4E4FF">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header fw-bold bg-primary text-light">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (Auth::user()->role == 1)
                            Selamat Datang ADMIN <b>{{ Auth::user()->name }}</b>
                            <br>
                            <br>
                            ADMIN Memiliki Wewenang Untuk <b>Membuat, Merubah, dan Menghapus Data.</b>
                        @elseif (Auth::user()->role == 2)
                            Selamat Datang KASIR <b>{{ Auth::user()->name }}</b>
                            <br>
                            <br>
                            Kasir Memiliki Wewenang Untuk <b>Mengawasi Member dan Mencetak Bukti Transaksi.</b>
                        @elseif (Auth::user()->role == 3)
                            Selamat Datang PEMILIK <b>{{ Auth::user()->name }}</b>
                            <br>
                            <br>
                            Pemilik Memiliki Wewenang Untuk <b>Mencetak Bukti Transaksi.</b>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
