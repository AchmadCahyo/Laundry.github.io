@extends('layouts.main')

@section('content')
    <div class="container" style="background-color: #C4E4FF">
        <div class="row justify-content-center">
            @if ($message = Session::get('sukses'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header fw-bold bg-info">
                        Data Transaksi
                    </div>

                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Outlet</th>
                                    <th scope="col">Member</th>
                                    <th scope="col">Diterima</th>
                                    <th scope="col">Berat Cucian</th>
                                    <th scope="col">Diambil</th>
                                    <th scope="col">Tanggal Dibayar</th>
                                    <th scope="col">Biaya Tambahan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Status Bayar</th>
                                    <th scope="col">Petugas</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksi as $no => $t)
                                    <tr>
                                        <th scope="row">{{ ++$no }}</th>
                                        <td>{{ $t->outlet->name }}</td>
                                        <td>{{ $t->member->name }}</td>
                                        <td>{{ $t->tanggal }}</td>
                                        <td>{{ $t->member->jumlah_berat }} kg</td>
                                        <td>{{ $t->batas_waktu }}</td>
                                        <td>{{ $t->tanggal_bayar }}</td>
                                        <td>{{ number_format($t->biaya_tambahan, 2, ',', '.') ?? '0' }}</td>
                                        <td>{{ $t->status }}</td>
                                        <td>{{ $t->dibayar }}</td>
                                        <td>{{ $t->user->name }}</td>
                                        <td>
                                            @if (Auth::user()->role == 1)
                                                <a href="#" class="btn-sm btn btn-outline-secondary mt-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $t->id }}">Update</a>

                                                <a href="#" class="btn-sm btn btn-outline-danger mt-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#del{{ $t->id }}">Delete</a>

                                                <a href="{{ route('transaksi.create') }}"
                                                    class="btn-sm btn btn-outline-success mt-2">Print</a>
                                            @elseif (Auth::user()->role == 2)
                                                <a href="{{ route('transaksi.create') }}"
                                                    class="btn-sm btn btn-outline-success">Print</a>
                                            @elseif (Auth::user()->role == 3)
                                                <a href="{{ route('transaksi.create') }}"
                                                    class="btn-sm btn btn-outline-success">Print</a>
                                            @endif
                                        </td>
                                    @empty
                                        <div class="alert alert-danger" role="alert">
                                            Data Kosong
                                        </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $transaksi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal update --}}
    @foreach ($transaksi as $t)
        <div class="modal fade" tabindex="-1" id="edit{{ $t->id }}" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-dark" style="background-color: #AAAAAA">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Data Transaksi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('transaksi.update', $t->id) }}" method="POST" class="row g-3">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <label class="form-label fw-bold"> Outlet</label>
                                <input type="text" class="form-control" name="outlet_id"
                                    @error('outlet_id')
                                is-invalid
                                @enderror
                                    value="{{ old('outlet_id', $t->outlet_id) }}" readonly>

                                @error('outlet_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Nama Member</label>
                                <input type="text" class="form-control" name="member_id"
                                    @error('member_id')
                                is-invalid
                                @enderror
                                    value="{{ old('member_id', $t->member_id) }}" readonly>

                                @error('member_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tanggal Terima</label>
                                <input type="date" class="form-control" name="tanggal"
                                    @error('tanggal')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan tanggal Member" value="{{ old('tanggal', $t->tanggal) }}">

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
                                    placeholder="Masukkan batas_waktu Member"
                                    value="{{ old('batas_waktu', $t->batas_waktu) }}">

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
                                    placeholder="Masukkan tanggal_bayar Member"
                                    value="{{ old('tanggal_bayar', $t->tanggal_bayar) }}">

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
                                    placeholder="Masukkan Biaya Tambahan Bila Ada"
                                    value="{{ old('biaya_tambahan', $t->biaya_tambahan) }}">

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
                                    placeholder="Masukkan Diskon Bila Ada" value="{{ old('diskon', $t->diskon) }}">

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
                                    placeholder="Masukkan Pajak Bila Ada" value="{{ old('pajak', $t->pajak) }}">

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
                                    <option selected>{{ old('status', $t->status) }}</option>
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
                                    <option selected>{{ old('dibayar', $t->dibayar) }}</option>
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
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- modal delete --}}
    @foreach ($transaksi as $t)
        <div class="modal fade" id="del{{ $t->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-light" style="background-color: #EF4040">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-bold fs-4">Hapus Data Transaksi?</p>
                        <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
