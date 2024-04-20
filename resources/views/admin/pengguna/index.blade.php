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
                        Data Pengguna
                    </div>

                    <div class="card-body text-center">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Outlet</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($user as $no => $u)
                                    <tr>
                                        <th scope="row">{{ ++$no }}</th>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->outlet->name }}</td>
                                        <td>
                                            <a href="#" class="btn-sm btn btn-outline-secondary" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $u->id }}">Update</a>

                                            <a href="#" class="btn-sm btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#del{{ $u->id }}">Delete</a>
                                        </td>
                                    @empty
                                        <div class="alert alert-danger" role="alert">
                                            Data Kosong
                                        </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $user->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal update --}}
    @foreach ($user as $u)
        <div class="modal fade" tabindex="-1" id="edit{{ $u->id }}" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-dark" style="background-color: #AAAAAA">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Data Pengguna</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pengguna.update', $u->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Pengguna</label>
                                <input type="text" class="form-control" name="name"
                                    @error('name')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Nama Member" value="{{ old('name', $u->name) }}">

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
                                    placeholder="Masukkan Email Member" value="{{ old('email', $u->email) }}">

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
                                    placeholder="Masukkan password Member" value="{{ old('password', $u->password) }}">

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
                                    <option selected>{{ old('role', $u->role) }}</option>
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
                                    <option selected>{{ old('outlet_id', $u->outlet_id) }}</option>
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
    @foreach ($user as $u)
        <div class="modal fade" id="del{{ $u->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-light" style="background-color: #EF4040">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-bold fs-4">Hapus Data Petugas Atas Nama {{ $u->name }}?</p>
                        <form action="{{ route('pengguna.destroy', $u->id) }}" method="POST">
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
