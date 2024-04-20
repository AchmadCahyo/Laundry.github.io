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
                        Tambah Data Paket
                    </div>

                    <div class="card-body">
                        <form action="{{ route('paket.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Outlet</label>
                                <select class="form-select form-select-md mb-3" name="outlet_id"
                                    @error('outlet_id')
                                        is-invalid
                                    @enderror
                                    required>
                                    <option selected>Pilih Outlet</option>
                                    @foreach ($outlet as $o)
                                        <option value="{{ $o->id }}">{{ $o->name }}</option>
                                    @endforeach
                                </select>

                                @error('outlet_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Jenis Cucian</label>
                                <select class="form-select form-select-md mb-3" name="jenis"
                                    @error('jenis')
                                        is-invalid
                                    @enderror
                                    required>
                                    <option selected>Pilih Jenis Cucian</option>
                                    <option value="kilo">Kiloan (Baju, Celana)</option>
                                    <option value="bed_cover">Bed Cover</option>
                                    <option value="elimut">Selimut</option>
                                </select>

                                @error('jenis')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Paket</label>
                                <input type="text" class="form-control" name="nama_paket"
                                    @error('nama_paket')
                                    is-invalid
                                    @enderror
                                    placeholder="Masukkan Nama Paket" required>

                                @error('nama_paket')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Harga</label>
                                <input type="number" class="form-control" name="harga"
                                    @error('harga')
                                    is-invalid
                                    @enderror
                                    placeholder="Masukkan Harga" required>

                                @error('harga')
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
