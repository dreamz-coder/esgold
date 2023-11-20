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
                                User form
                            </p>
                            <form class="forms-sample" action="{{ route('admin.epin.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror"
                                        id="userSelect">
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Count</label>
                                    <input type="text" name="count" value="{{ old('count') }}"
                                        class="form-control @error('count') is-invalid @enderror" id="exampleInputcount1"
                                        placeholder="Enter count" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        maxlength="3" minlength="1">
                                    @error('count')
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
