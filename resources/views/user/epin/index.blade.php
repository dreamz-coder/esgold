@extends('admin.main')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Epin List</h4>
                        <p class="card-description">
                            <!-- <a style="text-decoration: none;" href="{{ route('admin.epin.create') }}">Add Epin <i class="fas fa-plus primary mr-1"></i></a> -->
                        </p>
                        <div class="table-responsive">
                            @if (count($epins) > 0)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Id</th>
                                        <th>Epin</th>
                                        <th>Transfer</th>
                                        <th>Register</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($epins as $epin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $epin?->user?->user_id }}</td>
                                        <td>{{ $epin->epin }}</td>
                                        <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#TransferModal{{$epin->id}}">
                                                Transfer
                                            </button>
                                        </td>
                                        <td><a class="btn btn-primary" href="{{ route('user.epin.edit', $epin->id) }}">Register</a></td>
                                        <div class="modal fade" id="TransferModal{{$epin->id}}" tabindex="-1" role="dialog" aria-labelledby="TransferModal{{$epin->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="TransferModal{{$epin->id}}Label">Transfer EPIN</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('user.epin.update',$epin->id)}}" method="POST">
                                                        @csrf
                                                        @method("PUT")
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input class="form-control" value=" {{$epin->epin}}" name="epin" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" id="userSelect">
                                                                    <option value="">Select User</option>
                                                                    @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
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
                                                                <label for="reson"><b>Reason:</b></label>
                                                                <textarea name="reason" class="form-control id=" cols="30" rows="10">{{ old('reason') }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Transfer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                        </div>
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
