@extends('admin.main')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Dear {{ $user->name }}, if you want to withdraw an amount, you need to fill in these details.</h4>
                        <p class="card-description">
                            Add Your Account Details Here
                        </p>
                        <form class="forms-sample" action="{{ route('user.updateAccountDetails', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputName1">Bank Name</label>
                                <input type="text" name="bank_name" value="{{ old('bank_name', $user) }}" class="form-control @error('bank_name') is-invalid @enderror" id="exampleInputbank_name1" placeholder="Enter Bank name">
                                @error('bank_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Account Number</label>
                                <input type="text" name="account_number" value="{{ old('account_number', $user) }}" class="form-control @error('account_number') is-invalid @enderror" id="exampleInputaccount_number1" placeholder="Enter Account Number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="" minlength="">
                                @error('account_number')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">IFSC Code</label>
                                <input type="text" name="ifsc" value="{{ old('ifsc', $user) }}" class="form-control @error('ifsc') is-invalid @enderror" id="exampleInputifsc1" placeholder="Enter ifsc">
                                @error('ifsc')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Branch Name</label>
                                <input type="text" name="branch_name" value="{{ old('branch_name', $user) }}" class="form-control @error('branch_name') is-invalid @enderror" id="exampleInputbranch_name1" placeholder="Enter branch_name">
                                @error('branch_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
