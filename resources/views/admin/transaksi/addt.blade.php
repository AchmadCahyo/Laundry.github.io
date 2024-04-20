@extends('layouts.main')

@section('content')
    <div class="container" style="background-color: #C4E4FF">
        <div class="row justify-content-center">
            @if ($message = Session::get('sukses'))
                <div class="alert alert-secondary" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header fw-bold bg-info">
                        Buat Data Transaksi
                    </div>

                    <div class="card-body">
                        <form action="{{ route('transaksi.store') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Outlet</label>
                                <select class="form-select form-select-md mb-3" name="outlet_id"
                                    @error('outlet_id')
                                    is-invalid
                                @enderror
                                    required autofocus>
                                    <option selected disabled>Outlet</option>
                                    @foreach ($outlet as $o)
                                        <option value="{{ $o->id }}">{{ $o->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Nama Member</label>
                                <select class="form-select form-select-md mb-3" name="member_id"
                                    @error('member_id')
                                    is-invalid
                                @enderror
                                    required>
                                    <option selected disabled>Nama Member</option>
                                    @foreach ($member as $m)
                                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tanggal Terima</label>
                                <input type="date" class="form-control" name="tanggal"
                                    @error('tanggal')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan tanggal Member">

                                @error('tanggal')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tanggal Ambil</label>
                                <input type="date" class="form-control" name="batas_waktu"
                                    @error('batas_waktu')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan batas_waktu Member">

                                @error('batas_waktu')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tanggal Dibayar</label>
                                <input type="date" class="form-control" name="tanggal_bayar"
                                    @error('tanggal_bayar')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan tanggal_bayar Member">

                                @error('tanggal_bayar')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Biaya Tambahan</label>
                                <input type="number" class="form-control" name="biaya_tambahan"
                                    @error('biaya_tambahan')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Biaya Tambahan Bila Ada">

                                @error('biaya_tambahan')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Diskon</label>
                                <input type="number" class="form-control" name="diskon"
                                    @error('diskon')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Diskon Bila Ada">

                                @error('diskon')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Pajak</label>
                                <input type="number" class="form-control" name="pajak"
                                    @error('pajak')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Pajak Bila Ada">

                                @error('pajak')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Status</label>
                                <select class="form-select form-select-md mb-3" name="status"
                                    @error('status')
                                    is-invalid
                                @enderror
                                    required>
                                    <option selected disabled>Status Barang</option>
                                    <option value="Baru">Baru Datang</option>
                                    <option value="Proses">Dalam Proses</option>
                                    <option value="Selesai">Selesai Dikerjakan</option>
                                    <option value="Diambil">Barang Diambil</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Status Pembayaran</label>
                                <select class="form-select form-select-md mb-3" name="dibayar"
                                    @error('dibayar')
                                    is-invalid
                                @enderror
                                    required>
                                    <option selected disabled>Status Pembayaran</option>
                                    <option value="Dibayar">Telah Dibayar</option>
                                    <option value="Belum-Bayar">Belum Dibayar</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Pembuat Laporan</label>
                                <input type="text" class="form-control" name="user_id"
                                    @error('user_id')
                                is-invalid
                                @enderror
                                    value="{{ Auth::user()->id }}" readonly>

                                @error('user_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="justify-content-between">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
