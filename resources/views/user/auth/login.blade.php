<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themewagon.github.io/star-admin2-free-admin-template/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Oct 2023 06:23:42 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ url('admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('admin/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ url('public/admin/mlmlogo.jpeg') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="{{ url('public/admin/mlmlogo.jpeg') }}" alt="logo">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="fw-light">Sign in to continue.</h6>
                            <form class="pt-3" action="{{ route('loggedin') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="User" name="user_id" value="{{ old('user_id') }}"
                                        class="form-control form-control-lg" id="exampleInputEmail1"
                                        placeholder="UserID" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Password" required>
                                </div>
                                <div class="mt-3">
                                    <center> <button
                                            class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                            type="submit">SIGN IN</button></center>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <!-- <a href="{{ route('login') }}" class="auth-link text-black">Admin Login</a> -->
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ url('admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ url('admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ url('admin/js/off-canvas.js') }}"></script>
    <script src="{{ url('admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ url('admin/js/template.js') }}"></script>
    <script src="{{ url('admin/js/settings.js') }}"></script>
    <script src="{{ url('admin/js/todolist.js') }}"></script>
    <!-- endinject -->
</body>


<!-- Mirrored from themewagon.github.io/star-admin2-free-admin-template/pages/samples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Oct 2023 06:23:42 GMT -->

</html>
