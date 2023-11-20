@extends('admin.main')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Epin Transfer</h4>
                            <p class="card-description">
                                <?php //dd($user->epin); ?>
                                {{ $user->name }}'s Epins
                            </p>
                            <div class="table-responsive">
                                @if (count($user->epin) > 0 )
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Epin</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->epin as $epin)
                                            @if($epin->is_used == 0)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $epin->epin }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#exampleModal{{ $epin->id }}">
                                                            Transfer
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal{{ $epin->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Transfer Epin</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="forms-sample"
                                                                            action="{{ route('admin.transfer.update', $user->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="form-group">
                                                                                <div class="form-group">
                                                                                    <input class="form-control"
                                                                                        type="text"
                                                                                        value="{{ $epin->epin }}"
                                                                                        readonly>
                                                                                    <input class="form-control"
                                                                                        type="text" name="epin_id"
                                                                                        value="{{ $epin->id }}" hidden>
                                                                                    <input class="form-control"
                                                                                        type="text" name="from"
                                                                                        value="{{ $user->id }}" hidden>
                                                                                </div>

                                                                                <select name="user_id"
                                                                                    class="form-control @error('user_id') is-invalid @enderror"
                                                                                    id="userSelect" required>
                                                                                    <option value="">Select User
                                                                                    </option>
                                                                                    @foreach ($users as $user)
                                                                                        <option value="{{ $user->id }}"
                                                                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                                                            {{ $user->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('user_id')
                                                                                    <span class="invalid-feedback"
                                                                                        role="alert">
                                                                                        {{ $message }}
                                                                                    </span>
                                                                                @enderror
                                                                                <div class="form-group">
                                                                                    <label for="reson"><b>Reason:</b></label>
                                                                                    <textarea name="reason"  class="form-control id=" cols="30" rows="10">{{ old('reason') }}</textarea>
                                                                                </div>
                                                                            </div>


                                                                            <div class="modal-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Transfer</button>
                                                                            </div>

                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @else
                                                <p>No Record Found</p>
                                                @endif
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
        <script type="text/javascript">
            $('#userSelect').on('change',function(){
          var user = $(this).find(":selected").val();
          console.log(user);


          $.ajax({
             url: "route('userdetails)",
            data:{id: user},
            cache: false,
            success: function(html){
                console.log(html);
            }
        });
        });
            </script>
    @endsection
