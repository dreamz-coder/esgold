@extends('admin.main')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">User</h4>
                            <p class="card-description">
                                User Edit form
                            </p>
                            <form class="forms-sample" action="{{ route('admin.user.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" name="name" value="{{ old('name', $user) }}"
                                        class="form-control @error('name') is-invalid @enderror" id="exampleInputName1"
                                        placeholder="Enter Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Mobile</label>
                                    <input type="text" name="mobile" value="{{ old('mobile', $user) }}"
                                        class="form-control @error('mobile') is-invalid @enderror" id="exampleInputmobile1"
                                        placeholder="Enter Mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        maxlength="10" minlength="10">
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Email</label>
                                    <input type="text" name="email" value="{{ old('email', $user) }}"
                                        class="form-control @error('email') is-invalid @enderror" id="exampleInputemail1"
                                        placeholder="Enter email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Your Referral Code</label>
                                    <input type="text" name="referral_code" value="{{ old('referral_code', $user) }}"
                                        class="form-control @error('referral_code') is-invalid @enderror"
                                        id="exampleInputreferral_code1" placeholder="Enter Referral Code" disabled>
                                    @error('referral_code')
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
