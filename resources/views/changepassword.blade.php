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
                               Change Password
                            </p>
                            <form class="forms-sample" id="changepassword" action="{{ route('user.change-password.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}"
                                    <label for="exampleInputName1">Password</label>
                                    <input type="password" name="password" value=""
                                        class="form-control " id="exampleInputcount1"
                                        placeholder="Enter Password" >
                                  <label class="error" style="color:red">Please enter password</label>
                                </div>


                                {{-- <button class="btn btn-light">Cancel</button> --}}
                            </form>
                            <button  class="submitclick btn btn-primary me-2">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script>
        $(document).ready(function(){
            $('.error').css('display','none');
        });
        $('.submitclick').click(function(){
            var password = $('#exampleInputcount1').val();
            if(password == ''){
                $('.error').css('display','block');
            }
            else{
                $('.error').css('display','none');
                document.getElementById("changepassword").submit();
            }
        })
    </script>
    @endsection
