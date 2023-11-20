@extends('admin.main')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">User List</h4>
                            <p class="card-description">
                                {{-- <a style="text-decoration: none;" href="{{ route('admin.user.create') }}">Add User <i
                                        class="fas fa-plus primary mr-1"></i></a> --}}
                            </p>
                            <div class="container text-center">
                                <form action="{{ route('admin.report.member') }}" method='get' class="row">
                                    <div class="col-4">
                                        <input type="text" class="form-control" id="user_id" name="user_id" value="{{$user}}" placeholder="Enter user id">
                                    </div>
                                    <div class="col-3">
                                        <label for="from_date">From:</label>
                                        <input type="date" class="form-control" id="from_date" name="from_date" value="{{$from_date}}">
                                    </div>
                                    <div class="col-3">
                                        <label for="to_date">To:</label>
                                        <input type="date" class="form-control" id="to_date" name="to_date" value="{{$to_date}}">
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-primary m-btn m-btn--air m-btn--custom" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                    <div class="col-1">
                                        <a class="btn btn-danger m-btn m-btn--air m-btn--custom" href="{{ route('admin.report.member') }}"><i class="fa fa-times"></i></a>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                @if (count($users) > 0)
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>UserID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Referral Code</th>
                                                <th>Referred By</th>
                                                <th>Level</th>
                                                <th>Wallet</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->user_id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->mobile }}</td>
                                                    <td>{{ $user->referral_code }}</td>
                                                    <td>{{ $user->referred_by ? $user->referred_by : 'SELF' }}</td>
                                                    <td>{{ $user->level }}</td>
                                                    <td>{{ $user->wallet }}</td>

                                                    <!-- Modal -->

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
