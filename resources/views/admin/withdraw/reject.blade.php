@extends('admin.main')
@section('content')
<style>
    #withdrawlModal {
  backdrop-filter: blur(5px);
}
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
@if (session()->has('popup','open'))

<script>
    $(function() {
        $('#withdrawlModal').modal('hide');
      $('#walletsuccess').removeClass('fade');
      $('#walletsuccess').modal('show');
    });
</script>
@endif
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">User Accept History</h4>
                            <p class="card-description">

                            </p>
                            <div class="table-responsive">
                                @if (count($withdraw) > 0)
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Amount</th>
                                                <th>Withdraw Amount</th>
                                                <th>Tax</th>
                                                <th>Note</th>
                                                <th>Status</th>
                                                <th>Reason</th>
                                                <th>Requested Date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($withdraw as $withdraw)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $withdraw?->user?->user_id }}</td>
                                                    <td>{{ $withdraw?->user?->name }}</td>
                                                    <td>{{ $withdraw?->amount }}</td>
                                                    <td>{{$withdraw?->withdraw_amount}}</td>
                                                    <td>{{ $withdraw?->tax }}</td>
                                                    <td>{{ $withdraw?->note }}</td>
                                                    <td>@if($withdraw->status == 2) Rejected @endif</td>
                                                    <td>{{ $withdraw?->reason}} </td>
                                                    <td>{{ $withdraw?->created_at->format('d-m-Y h:i A') }}</td>
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
