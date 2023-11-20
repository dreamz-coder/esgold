@extends('admin.main')
@section('content')
<style>
    #withdrawlModal {
  backdrop-filter: blur(5px);
}
</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
@if (session()->has('popup','open'))

<script>
    $(function() {
        $('#withdrawlModal').modal('hide');
      $('#walletsuccess').removeClass('fade');
      $('#walletsuccess').modal('show');
    });
</script>
@endif
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">User Withdraw Request</h4>
                            <p class="card-description">

                            </p>
                            <form action="{{ route('admin.report.request') }}" method='get' class="row">
                                <div class="col-4">
                                    <input type="text" class="form-control" id="user_id" name="user_id" value="{{$user}}" placeholder="Enter user id">
                                </div>
                                <div class="col-3">
                                    <label for="from_date">From:</label>
                                    <input type="date" class="form-control" id="from_date" name="from_date" value="{{$from_date}}">
                                </div>
                                <div class="col-3">
                                    <label for="to_date">To:</label>
                                    <input type="date" class="form-control" id="to_date" name="to_date" value="{{$to_date}}">
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-primary m-btn m-btn--air m-btn--custom" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                                <div class="col-1">
                                    <a class="btn btn-danger m-btn m-btn--air m-btn--custom" href="{{ route('admin.report.request') }}"><i class="fa fa-times"></i></a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                @if (count($withdraw) > 0)
                                    <table class="table table-striped" id="withdrawtable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Amount</th>
                                                <th>Withdraw Amount</th>
                                                <th>Tax</th>
                                                <th>Note</th>
                                                <th>Status</th>
                                                <th>Requested Date</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($withdraw as $withdraw)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $withdraw?->user?->user_id }}</td>
                                                    <td>{{ $withdraw?->user?->name }}</td>
                                                    <td>{{ $withdraw?->amount }}</td>
                                                    <td>{{$withdraw?->withdraw_amount}}</td>
                                                     <td>{{$withdraw?->tax}}</td>
                                                    <td>{{ $withdraw?->note }}</td>
                                                    <td>@if($withdraw->status == 0) Pending @endif</td>
                                                    <td>{{ $withdraw?->created_at->format('d-m-Y h:i A') }}</td>
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

        <!--- user model withdraw request--->
        <div class="modal fade"  data-backdrop="static" id="withdrawlModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" >
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Withdraw Request</h5>
                  <button type="button" class="close closemodal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body formvalue">

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary closemodal" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary saveformdata">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        <!--- user model withdraw request -->
        <!--- user success popup --->
        <div id="walletsuccess" class="modal fade" >
            <div class="modal-dialog modal-confirm modal-sm">
                <div class="modal-content">
                    <div class="modal-header" style="background: #34B1AA;
                    color: #ffffff;">
                        <center><h4 class="modal-title" >Success</h4>	</center>
                    </div><hr>
                    <div class="modal-body">
                        <p class="text-center success-msg">Status Changed Successfully</p>
                    </div>
                    {{-- <div class="modal-footer">
                        <button class="btn btn-success btn-block" data-bs-dismiss="modal">OK</button>
                    </div> --}}
                </div>
            </div>
        </div>
        <!--- user success popup -->
        <script type="text/javascript">
        $(document).ready(function(){
            $('.error').addClass('hide');
            $('#withdrawlModal').modal('hide');
            $(document).on("change","input[name='status']" ,function() {
      console.log("radio changed");
      var status_show =  $(this).val();
            console.log(status_show);
            if(status_show == 2){
                    $('#reason').css('display','block');
                }
  });

        });

        $("#withdrawtable").on("click", ".userWithdrawRequest", function(){
          var user = $(this).attr('data-user_id');
          console.log(user);


          $.ajax({
             url: "{{route('admin.withdrawUser')}}",
            data:{id: user},
            cache: false,
            success: function(html){
                console.log(html);
                $('.formvalue').html(html.view);
                $('#withdrawlModal').modal('show');
            }
        });
        });
        $('.closemodal').on('click',function(){
            $('#withdrawlModal').modal('hide');
        });
        $('.saveformdata').on('click',function(){
            var status = $('.status:checked').length;
            var status_val = $('.status:checked').val();
            console.log(status_val);
            console.log(status);
            var statusname = true,reasonname = true;
           var reason = $('#reason_change').val();
           console.log(reason);
            if(status == 0){
                $('.error').removeClass('fade');
                statusname = false;
            }
            else{
                $('.error').addClass('fade');
                statusname = true;
            }
            if(status_val == 2 && reason == '' ){
                $('.reason-error').removeClass('fade');
                reasonname = false;
            }
            else{
                $('.reason-error').addClass('fade');
                reasonname = true;
            }

            if(statusname == true && reasonname == true){
                $('#withdrawlModal').modal('hide');
                form_data = $("#withdrawForm").serialize();
                $.ajax({
             url: "{{route('admin.withdrawlstore')}}",
            data:form_data,
            type:'post',
            cache: false,
            success: function(html){
                console.log(html);
                $('#withdrawlModal').modal('hide');
                $('#walletsuccess').modal('show');
                setTimeout(function(){
             window.location.reload();
                },1000);

            }
        });
            }
        })
            </script>
    @endsection
