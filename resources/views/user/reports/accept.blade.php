@extends('admin.main')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">With Drawl Histories</h4>
                        <p class="card-description">
                        <div class="float-right">

                        </div>
                        </p>
                        <div class="container text-center">
                            <form action="{{ route('user.report.accept') }}" method='get' class="row">
                                {{-- <div class="col-4">
                                    <input type="text" class="form-control" id="user_id" name="user_id" value="{{$user}}" placeholder="Enter user id">
                                </div> --}}
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
                                    <a class="btn btn-danger m-btn m-btn--air m-btn--custom" href="{{ route('user.report.accept') }}"><i class="fa fa-times"></i></a>
                                </div>
                            </form>
                        </div>
                        @php
                        $user = Auth::user();
                        @endphp
                        <!-- Modal -->


                        <div class="table-responsive">
                            @if (count($withdrawls) > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Account Number</th>
                                        <th>Amount</th>
                                        <th>Withdraw Amount</th>
                                        <th>Tax</th>
                                        <th>status</th>
                                        <th>Notes</th>
                                        <th>Transfer At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdrawls as $withdrawl)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $withdrawl->user?->user_id }}</td>
                                        <td> {{$withdrawl->user?->name  }}</td>
                                        <td>{{ $withdrawl->user?->account_number }}</td>
                                        <td>{{ $withdrawl->amount }}</td>
                                        <td>{{$withdrawl->withdraw_amount}}</td>
                                        <td>{{$withdrawl->tax}}</td>
                                        @php
                                        $statusText = [
                                        0 => 'Pending',
                                        1 => 'Accepted',
                                        2 => 'Rejected',
                                        ];
                                        @endphp

                                        <td style="color:
    @if ($withdrawl->status === 0)
        blue
    @elseif ($withdrawl->status === 1)
        green
    @elseif ($withdrawl->status === 2)
        red
    @else
        black
    @endif">
                                            {{ $statusText[$withdrawl->status] }}
                                        </td>

                                        <td>{{ $withdrawl->notes }}</td>
                                        <td>{{ $withdrawl->created_at->format('d-m-Y h:i A') }}</td>
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

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
<script type="text/javascript">
    function taxamount(amount){
console.log(amount);
var tax_amount       = amount * 10 / 100;
var invoice_totalled = amount - tax_amount;
$('.withdraw_amt').text(invoice_totalled);
$('.tax_amt').text(tax_amount);
$('.withdraw_amt_text').val(invoice_totalled);
$('.tax_amt_text').val(tax_amount);
    }
</script>
    @endsection
