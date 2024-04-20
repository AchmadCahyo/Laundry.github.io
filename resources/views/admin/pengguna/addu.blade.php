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
                        Tambah Data Pengguna
                    </div>

                    <div class="card-body">
                        <form action="{{ route('pengguna.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Pengguna</label>
                                <input type="text" class="form-control" name="name"
                                    @error('name')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Nama Member">

                                @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email Pengguna</label>
                                <input type="email" class="form-control" name="email"
                                    @error('email')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Email Member">

                                @error('email')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Password Pengguna</label>
                                <input type="password" class="form-control" name="password"
                                    @error('password')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan password Member">

                                @error('password')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Role Pengguna</label>
                                <select class="form-select form-select-md mb-3" name="role"
                                    @error('role')
                                    is-invalid
                                @enderror
                                    required>
                                    <option selected>Pilih Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Kasir</option>
                                    <option value="3">Pemilik</option>
                                </select>

                                @error('role')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Outlet Pengguna</label>
                                <select class="form-select form-select-md mb-3" name="outlet_id"
                                    @error('outlet_id')
                                    is-invalid
                                @enderror
                                    required>
                                    <option selected>Outlet Pengguna</option>
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
