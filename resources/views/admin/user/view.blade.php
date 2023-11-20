@extends('admin.main')
@section('content')
<style>
    .black {
        color: black;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">View User Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.card -->
    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Check the Below Details</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="card card-primary card-outline mt-3" style="background-color: lightgray;">
                        <div class="card-body">
                            <h5 class="card-title mb-3 black">{{ $user->fname . ' ' . $user->lname }}'s Details </h5>
                            @if ($user->experience>0)
                            <h6 class="badge-primary black float-right">Experience: {{$user->experience}}</h6>
                            @else
                            <h6 class="badge-danger black float-right">Experience: Null</h6>
                            @endif
                            <p class="card-text">
                            <div class="row">
                                <div class="col-4 black">
                                    <label for="fname">Name:</label>
                                </div>
                                <div class="col-8 black">
                                    {{ $user->fname . ' ' . $user->lname }}
                                </div>

                                <div class="col-2 black">
                                    <label for="fname">Mobile:</label>
                                </div>
                                <div class="col-4 black">
                                    {{ $user->mobile }}
                                </div>
                                <div class="col-2 black">
                                    <label for="fname">Email:</label>
                                </div>
                                <div class="col-4 black">
                                    {{ $user->email }}
                                </div>

                                <div class="col-2 black">
                                    <label for="fname">City:</label>
                                </div>
                                <div class="col-4 black">
                                    {{ $user->city }}
                                </div>
                                <div class="col-2 black">
                                    <label for="fname">State:</label>
                                </div>
                                <div class="col-4 black">
                                    {{ $user->state }}
                                </div>

                                <div class="col-2 black">
                                    <label for="fname">Country:</label>
                                </div>
                                <div class="col-4 black">
                                    {{ $user->country }}
                                </div>
                                <div class="col-2 black">
                                    <label for="fname">Time Zone:</label>
                                </div>
                                <div class="col-4 black">
                                    {{ $user->timeZone }}
                                </div>

                            </div>

                            </p>
                            <a href="{{route('admin.user.index')}}" class="card-link">Back</a>
                            <!-- <a href="#" class="card-link">Another link</a> -->
                        </div>
                    </div><!-- /.card -->
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
</div>
@endsection
