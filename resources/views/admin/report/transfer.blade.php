@extends('admin.main')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Transaction Histories</h4>

                            <div class="container text-center">
                                <form action="{{ route('admin.report.transfer') }}" method='get' class="row">
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
                                        <a class="btn btn-danger m-btn m-btn--air m-btn--custom" href="{{ route('admin.report.transfer') }}"><i class="fa fa-times"></i></a>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                @if (count($transactions) > 0)
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Amount</th>
                                                <th>Method</th>
                                                <th>Notes</th>
                                                <th>Transfer At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $transaction->user->user_id }}</td>
                                                    <td>{{ $transaction->user->name }}</td>
                                                    <td>{{ $transaction->amount }}</td>
                                                    <td
                                                        style="color: {{ $transaction->method === 'add' ? 'green' : 'red' }}">
                                                        {{ $transaction->method }}
                                                    </td>
                                                    <td>{{ $transaction->notes }}</td>
                                                    <td>{{ $transaction->created_at->format('d-m-Y h:i A') }}</td>
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
