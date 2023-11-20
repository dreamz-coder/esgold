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
                            <p class="card-description">

                            </p>
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
                                                    <td>{{ $transaction->user->id }}</td>
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
