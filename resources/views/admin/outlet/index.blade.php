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
                        Data Outlet
                    </div>

                    <div class="card-body text-center">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Nomor Telfon</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($outlet as $no => $o)
                                    <tr>
                                        <th scope="row">{{ ++$no }}</th>
                                        <td>{{ $o->name }}</td>
                                        <td>{{ $o->alamat }}</td>
                                        <td>{{ $o->telpon }}</td>
                                        <td>
                                            <a href="#" class="btn-sm btn btn-outline-secondary" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $o->id }}">Update</a>

                                            <a href="#" class="btn-sm btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#del{{ $o->id }}">Delete</a>
                                        </td>
                                    @empty
                                        <div class="alert alert-danger" role="alert">
                                            Data Kosong
                                        </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $outlet->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal update --}}
    @foreach ($outlet as $o)
        <div class="modal fade" tabindex="-1" id="edit{{ $o->id }}" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-dark" style="background-color: #AAAAAA">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Data Outlet</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('outlet.update', $o->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Outlet</label>
                                <input type="text" class="form-control" name="name"
                                    @error('name')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Nama Outlet" value="{{ old('name', $o->name) }}">

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
                                    placeholder="Masukkan Alamat Outlet" value="{{ old('alamat', $o->alamat) }}">

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
                                    placeholder="Masukkan Nomor Telfon Outlet" value="{{ old('telpon', $o->telpon) }}">

                                @error('telpon')
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
    @foreach ($outlet as $o)
        <div class="modal fade" id="del{{ $o->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-light" style="background-color: #EF4040">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-bold fs-4">Hapus Data Outlet {{ $o->name }}?</p>
                        <form action="{{ route('outlet.destroy', $o->id) }}" method="POST">
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
