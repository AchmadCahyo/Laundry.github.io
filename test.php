<!-- resources/views/users/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List of Users</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <ul class="list-group">
                            @foreach ($users as $user)
                                <li class="list-group-item">
                                    {{ $user->name }}
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary float-right">Edit</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- resources/views/users/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List of Users</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <ul class="list-group">
                            @foreach ($users as $user)
                                <li class="list-group-item">
                                    {{ $user->name }}
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary float-right">Edit</a>
                                </li>
                            @endforeach
                        </ul>
                        
                        <!-- Tambahkan link pagination jika diperlukan -->
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
