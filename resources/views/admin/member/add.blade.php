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
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header fw-bold bg-info">
                        Tambah Data Member
                    </div>

                    <div class="card-body">
                        <form action="{{ route('member.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Member</label>
                                <input type="text" class="form-control" name="name"
                                    @error('name')
                                    is-invalid
                                    @enderror
                                    placeholder="Masukkan Nama Member" required autofocus>

                                @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat Member</label>
                                <input type="text" class="form-control" name="alamat"
                                    @error('alamat')
                                    is-invalid
                                    @enderror
                                    placeholder="Masukkan Alamat Member" required>

                                @error('alamat')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold ">Jenis Kelamin Member</label>
                                <select class="form-select form-select-md mb-3" name="jenis_kelamin"
                                    @error('jenis_kelamin')
                                        is-invalid
                                    @enderror
                                    required>
                                    <option selected>Laki Laki Atau Perempuan</option>
                                    <option value="Perempuan">Perempuan</option>
                                    <option value="Laki-Laki">Laki Laki</option>
                                </select>

                                @error('jenis_kelamin')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nomor Telfon Member</label>
                                <input type="number" class="form-control" name="telpon"
                                    @error('telpon')
                                    is-invalid
                                    @enderror
                                    placeholder="Masukkan Nomor Telfon Member" required>

                                @error('telpon')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Paket</label>
                                <select class="form-select form-select-md mb-3" name="paket_id"
                                    @error('paket_id')
                                        is-invalid
                                    @enderror
                                    required>
                                    <option selected>Pilih Paket</option>
                                    @foreach ($paket as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_paket }}</option>
                                    @endforeach
                                </select>

                                @error('paket_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Berat Cucian</label>
                                <input type="number" class="form-control" name="jumlah_berat"
                                    @error('jumlah_berat')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Berat Cucian">

                                @error('jumlah_berat')
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
