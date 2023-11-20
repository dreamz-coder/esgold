@extends('admin.main')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Epin List</h4>
                            <p class="card-description">
                                <a style="text-decoration: none;" href="{{ route('admin.epin.create') }}">Add Epin <i
                                        class="fas fa-plus primary mr-1"></i></a>
                            </p>
                            <div class="table-responsive">
                                @if (count($epins) > 0)
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Epin</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($epins as $epin)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$epin?->user?->user_id }}</td>
                                                    <td>{{ $epin?->user?->name }}</td>
                                                    <td>{{ $epin->epin }}</td>
                                                    {{-- <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('admin.user.edit', $user->id) }}"><i
                                                                    class="fas fa-edit success mr-3"></i></a>
                                                            <a href="{{ route('admin.user.destroy', $user->id) }}"
                                                                onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }">
                                                                <i class="fas fa-trash f-16 danger"></i>
                                                            </a>
                                                            <form id="delete-form-{{ $user->id }}"
                                                                action="{{ route('admin.user.destroy', $user->id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <center>
                                        <h4><i class="fas fa-exclamation-circle mt-5"></i> No Records Found</h4>
                                    </center>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
