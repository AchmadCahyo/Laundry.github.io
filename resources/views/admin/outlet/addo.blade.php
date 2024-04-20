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
                        Tambah Data Outlet
                    </div>

                    <div class="card-body">
                        <form action="{{ route('outlet.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Outlet</label>
                                <input type="text" class="form-control" name="name"
                                    @error('name')
                                    is-invalid
                                    @enderror
                                    placeholder="Masukkan Nama Outlet" required autofocus>

                                @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Alamat Outlet</label>
                                <input type="text" class="form-control" name="alamat"
                                    @error('alamat')
                                    is-invalid
                                    @enderror
                                    placeholder="Masukkan Alamat Outlet" required>

                                @error('alamat')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nomor Telfon Outlet</label>
                                <input type="number" class="form-control" name="telpon"
                                    @error('telpon')
                                    is-invalid
                                    @enderror
                                    placeholder="Masukkan Nomor Telfon Outlet" required>

                                @error('telpon')
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
