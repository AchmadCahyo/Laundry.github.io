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
                        Data Paket
                    </div>

                    <div class="card-body text-center">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Outlet</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Nama Paket</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $jenis = 'kilo';
                                    $jenis = 'bed_cover';
                                    $jenis = 'selimut';
                                @endphp
                                @forelse ($paket as $no => $p)
                                    <tr>
                                        <th scope="row">{{ ++$no }}</th>
                                        <td>{{ $p->outlet->name }}</td>
                                        <td>{{ $p->jenis }}</td>
                                        <td>{{ $p->nama_paket }}</td>
                                        <td>{{ 'Rp. ' . number_format($p->harga, 2, ',', '.') }} / kg</td>
                                        <td>
                                            <a href="#" class="btn-sm btn btn-outline-secondary"
                                                data-bs-toggle="modal" data-bs-target="#edit{{ $p->id }}">Update</a>

                                            <a href="#" class="btn-sm btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#del{{ $p->id }}">Delete</a>
                                        </td>
                                    @empty
                                        <div class="alert alert-danger" role="alert">
                                            Data Kosong
                                        </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $paket->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal update --}}
    @foreach ($paket as $p)
        <div class="modal fade" tabindex="-1" id="edit{{ $p->id }}" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-dark" style="background-color: #AAAAAA">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Data Paket</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('paket.update', $p->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <select class="form-select form-select-md mb-3" name="outlet_id"
                                    @error('outlet_id')
                                        is-invalid
                                    @enderror
                                    required hidden>
                                    <option selected>{{ old('outlet_id', $p->outlet_id) }}</option>
                                </select>

                                @error('outlet_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <select class="form-select form-select-md mb-3" name="jenis"
                                    @error('jenis')
                                        is-invalid
                                    @enderror
                                    required hidden>
                                    <option selected>{{ old('jenis', $p->jenis) }}</option>
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
                                    placeholder="Masukkan Nama Paket" value="{{ old('nama_paket', $p->nama_paket) }}"
                                    required>

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
                                    placeholder="Masukkan Harga" value="{{ old('harga', $p->harga) }}" required>

                                @error('harga')
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
    @foreach ($paket as $p)
        <div class="modal fade" id="del{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-light" style="background-color: #EF4040">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-bold fs-4">Hapus Data Paket {{ $p->name }}?</p>
                        <form action="{{ route('paket.destroy', $p->id) }}" method="POST">
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
