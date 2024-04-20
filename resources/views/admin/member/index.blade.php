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
                        Data Member
                    </div>

                    <div class="card-body text-center">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Nomor Telfon</th>
                                    <th scope="col">Paket Dipilih</th>
                                    <th scope="col">Berat Cucian</th>
                                    @if (Auth::user()->role == 1)
                                        <th scope="col">Opsi</th>
                                    @elseif (Auth::user()->role == 2)
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($member as $no => $m)
                                    <tr>
                                        <th scope="row">{{ ++$no }}</th>
                                        <td>{{ $m->name }}</td>
                                        <td>{{ $m->alamat }}</td>
                                        <td>{{ $m->jenis_kelamin }}</td>
                                        <td>{{ $m->telpon }}</td>
                                        <td>{{ $m->paket->nama_paket }}</td>
                                        <td>{{ $m->jumlah_berat }} / kg</td>
                                        <td>
                                            @if (Auth::user()->role == 1)
                                                <a href="#" class="btn-sm btn btn-outline-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#edit{{ $m->id }}">Update</a>

                                                <a href="#" class="btn-sm btn btn-outline-danger" data-bs-toggle="modal"
                                                    data-bs-target="#del{{ $m->id }}">Delete</a>
                                            @elseif (Auth::user()->role == 2)

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
                        {{ $member->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal update --}}
    @foreach ($member as $m)
        <div class="modal fade" tabindex="-1" id="edit{{ $m->id }}" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-dark" style="background-color: #AAAAAA">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Data Member</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('member.update', $m->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama Member</label>
                                <input type="text" class="form-control" name="name"
                                    @error('name')
                                is-invalid
                                @enderror
                                    placeholder="Masukkan Nama Member" value="{{ old('name', $m->name) }}">

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
                                    placeholder="Masukkan Alamat Member" value="{{ old('alamat', $m->alamat) }}">

                                @error('alamat')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Jenis Kelamin Member</label>
                                <select class="form-select form-select-md mb-3" name="jenis_kelamin"
                                    @error('jenis_kelamin')
                                    is-invalid
                                @enderror
                                    required>
                                    <option selected>{{ old('jenis_kelamin', $m->jenis_kelamin) }}</option>
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
                                    placeholder="Masukkan Nomor Telfon Member" value="{{ old('telpon', $m->telpon) }}">

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
                                    <option selected>{{ old('paket_id', $m->paket->nama_paket) }}</option>
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
                                    placeholder="Masukkan Nomor Telfon Member" value="{{ old('jumlah_berat', $m->jumlah_berat) }}">

                                @error('jumlah_berat')
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
    @foreach ($member as $m)
        <div class="modal fade" id="del{{ $m->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-light" style="background-color: #EF4040">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fw-bold fs-4">Hapus Data Member Atas Nama {{ $m->name }}?</p>
                        <form action="{{ route('member.destroy', $m->id) }}" method="POST">
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
