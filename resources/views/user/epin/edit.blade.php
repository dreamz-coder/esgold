@extends('admin.main')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Register User With this Epin: {{$epin->epin}}</h4>
                        <p class="card-description">
                            Fill User Details
                        </p>
                        <form class="forms-sample" action="{{ route('user.epinRegister', $epin->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputName1">User ID</label>
                                <input type="text" name="referred_by" value="" class="form-control " id="user_id" placeholder="Enter UserID" oninput="user_details()">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" name="name" value="" class="form-control " id="user_name" placeholder="Enter Name" readonly>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Mobile</label>
                                <input type="text" name="mobile" value="" class="form-control " id="user_mobile" placeholder="Enter Mobile" readonly>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Referred By</label>
                                <input type="text" name="referred_by" value="{{ old('referral_code') }}" class="form-control @error('referred_by') is-invalid @enderror" id="user_ref" placeholder="Enter Referral Code" readonly>
                                @error('referred_by')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="exampleInputName1" placeholder="Enter Name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Mobile</label>
                                <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control @error('mobile') is-invalid @enderror" id="exampleInputmobile1" placeholder="Enter Mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10" minlength="10">
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Email</label>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" id="exampleInputemail1" placeholder="Enter email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Password</label>
                                        <input type="password" name="password" readonly value="12345678" class="form-control @error('password') is-invalid @enderror" id="exampleInputpassword1" placeholder="Enter password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Re-enter Password</label>
                                        <input type="password" readonly name="password_confirmation" value="12345678" class="form-control @error('password_confirmation') is-invalid @enderror" id="exampleInputpassword_confirmation1" placeholder="Enter password_confirmation">
                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function user_details() {
            var id = $('#user_id').val();
            console.log(id);
            var url = '{{ route("userdetails") }}';

            if (id.length > 7) {
                $.ajax({
                    url: url,
                    type: "get",
                    data: {
                        user: id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response.result.length);
                        if (response.result.length != 0) {
                            console.log(response.result[0]);
                            $('#user_name').val(response.result[0].name);
                            $('#user_mobile').val(response.result[0].mobile);
                            $('#user_ref').val(response.result[0].referral_code);
                        }

                    }
                });
            }
        }
    </script>
    @endsection
