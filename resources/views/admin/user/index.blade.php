@extends('admin.main')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">User List</h4>
                            <p class="card-description">
                                <a style="text-decoration: none;" href="{{ route('admin.user.create') }}">Add User <i
                                        class="fas fa-plus primary mr-1"></i></a>
                            </p>
                            <div class="table-responsive">
                                @if (count($users) > 0)
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>UserID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Referral Code</th>
                                                <th>Referred By</th>
                                                <th>Level</th>
                                                <th>Wallet</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->user_id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->mobile }}</td>
                                                    <td>{{ $user->referral_code }}</td>
                                                    <td>{{ $user->referred_by ? $user->referred_by : 'SELF' }}</td>
                                                    <td>{{ $user->level }}</td>
                                                    <td>{{ $user->wallet }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('admin.user.edit', $user->id) }}"><i
                                                                    class="fas fa-edit success mr-3"></i></a>
                                                            <i class="fas fa-exchange-alt success mr-3"
                                                                style="cursor: pointer; color: green;"
                                                                onclick="openTransferModal({{ $user->id }})"></i>
                                                            <script>
                                                                function openTransferModal(userId) {
                                                                    // Use the user's ID to target the corresponding modal and display it
                                                                    $('#transferModalLong' + userId).modal('show');
                                                                }
                                                            </script>

                                                            {{-- <a href="{{ route('admin.user.destroy', $user->id) }}"
                                                onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }">
                                                <i class="fas fa-trash f-16 danger"></i>
                                                </a> --}}
                                                            <form id="delete-form-{{ $user->id }}"
                                                                action="{{ route('admin.user.destroy', $user->id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="transferModalLong{{ $user->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="transferModalLong{{ $user->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="transferModalLong{{ $user->id }}">Wallet
                                                                        Transfer To {{ $user->name }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form
                                                                    action="{{ route('admin.walletTransfer', $user->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">

                                                                        <div class="form-group">
                                                                            <label for="reson"><b>Current
                                                                                    Ballance:</b></label>
                                                                            <input type="text" class="form-control"
                                                                                name="amount"
                                                                                value="RS: {{ $user->wallet }}">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Transfer Method</label><br>
                                                                            <input type="radio" name="method"
                                                                                value="add" id="addMethod" required>
                                                                            <label for="addMethod">Add</label>&nbsp;&nbsp;

                                                                            <input type="radio" name="method"
                                                                                value="subtract" id="subtractMethod">
                                                                            <label for="subtractMethod">Subtract</label>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="amount">Amount to Transfer</label>
                                                                            <input type="text"
                                                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                                                                class="form-control  @error('amount') is-invalid @enderror"
                                                                                id="amount" name="amount"
                                                                                value="{{ old('amount') }}">
                                                                            @error('amount')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    {{ $message }}
                                                                                </span>
                                                                            @enderror
                                                                        </div>

                                                                        @error('method')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                {{ $message }}
                                                                            </span>
                                                                        @enderror

                                                                        <div class="form-group">
                                                                            <label for="reson"><b>Reason:</b></label>
                                                                            <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" cols="30" rows="10">{{ old('notes') }}</textarea>
                                                                            @error('notes')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    {{ $message }}
                                                                                </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>


                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Proceed</button>
                                                                    </div>
                                                                </form>
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
        {{-- Modal --}}
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-primary"> <!-- Add a background color -->
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="successModalLabel">🎉 Success! 🎉</h5>
                        <!-- Add emojis and text color -->
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="successMessage" class="text-white"></p> <!-- Add text color -->
                    </div>
                </div>
            </div>
        </div>

        <script>
            @if (session('success'))
                $('#successMessage').text("{{ session('success') }}");
                $('#successModal').modal('show');

                // Automatically close the modal after 3 seconds (adjust the time as needed)
                setTimeout(function() {
                    $('#successModal').modal('hide');
                }, 3000);
            @endif
        </script>
    @endsection
