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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#withdrawlModal">
                                Make Withdraw
                            </button>
                        </div>
                        </p>
                        @php
                        $user = Auth::user();
                        @endphp
                        <!-- Modal -->
                        <div class="modal fade" id="withdrawlModal" tabindex="-1" role="dialog" aria-labelledby="withdrawlModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="withdrawlModalLabel">Withdraw Request</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="withdrawForm" action="{{route('user.withdrawl.store')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="account">Your Account Number:</label>
                                                <input type="text" class="form-control" value="{{$user->account_number}}" id="account" name="account" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Withdrawal Amount:</label>
                                                <input type="text" class="form-control" id="amount" name="amount" oninput="taxamount(this.value)" value="{{ old('amount') }}" required>
                                                <small style="font-size:11px">TDX 10% (5% tax + 5% admin charges) tax amount will be deducted from your amount </small><br/>
                                                <span  style="color:blue;font-size:11px">Withdraw Amount:<p class="withdraw_amt"></p></span>
                                                <span  style="color:red;font-size:11px">Tax Amount:<p class="tax_amt"></p></span>
                                                <input type="hidden" name="withdraw_amount" value="" class="withdraw_amt_text">
                                                <input type="hidden" name="tax" value="" class="tax_amt_text">
                                            </div>

                                            <div class="form-group">
                                                <label for="notes"><b>Notes:</b></label>
                                                <textarea name="notes" class="form-control id=" cols="30" rows="10">{{ old('notes') }}</textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" form="withdrawForm" class="btn btn-primary">Make Request</button>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                        <td>{{ $withdrawl->user?->name }}</td>
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
