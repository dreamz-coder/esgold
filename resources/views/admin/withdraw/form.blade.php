<form id="withdrawForm" action="{{route('admin.withdrawlstore')}}" method="post">
    @csrf
    <div class="form-group">
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <label for="account">User Account Number:</label>
        <input type="text" class="form-control" value="{{$user?->account_number}}" id="account" name="account" readonly>
    </div>
    <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="text" class="form-control" id="amount" name="amount" value="{{ $user?->amount }}" readonly>
    </div>
    <div class="form-group">
        <label for="withdraw_amount">Withdrawal Amount:</label>
        <input type="text" class="form-control" id="withdraw_amount" name="withdraw_amount" value="{{ $user?->withdraw_amount }}" readonly>
    </div>
    <div class="form-group">
        <label for="tax">Tax Amount:</label>
        <input type="text" class="form-control" id="tax" name="tax" value="{{ $user?->tax }}" readonly>
    </div>
    <div class="form-group">
        <label for="notes"><b>Request Date</b></label>
        <input type="text" class="form-control" id="amount" name="amount" value="{{ $user?->created_at->format('d-m-Y h:i A')  }}" readonly>
    </div>
    <div class="form-group" style="margion:0">
        <label>Status </label><br>
        <input type="radio" name="status"
            value="1" class="status" id="accept" required>
        <label for="accept">Accept</label>&nbsp;&nbsp;

        <input type="radio" name="status"
            value="2" class="status" id="reject">
        <label for="reject">Reject</label><br/>
        <label class="error fade" style="color:red;margin:0">Status is required</label>
    </div>
       <div class="form-group" id="reason" style="display:none;">
        <label for="reason"><b>Reason:</b></label>
        <textarea name="reason" class="form-control " id="reason_change" cols="30" rows="10">{{ old('reason') }}</textarea>
        <label class="reason-error fade" style="color:red;margin:0">Reason is required</label>
    </div>
</form>
