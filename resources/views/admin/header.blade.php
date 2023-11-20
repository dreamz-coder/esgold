<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themewagon.github.io/star-admin2-free-admin-template/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Oct 2023 06:23:21 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel</title>
    <link rel="shortcut icon" href="{{ url('public/admin/mlmlogo.jpeg') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <!-- plugins:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ url('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.html') }}">
    <link rel="stylesheet" href="{{ url('admin/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('admin/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    {{-- <link rel="shortcut icon" href="{{ url('admin/images/favicon.png')}}" /> --}}
    <link rel="stylesheet" href="{{ url('admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ url('admin/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ url('admin/css/vertical-layout-light/style.css') }}">
    <style>
        @media only screen and (max-width: 320px) {
            .s2 {
                width: 49%;
                /* Make the select element full-width */
            }
        }
    </style>
</head>

<body>
    @php
    $user = Auth::user();
    @endphp
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="">
                        <img src="{{ url('public/admin/mlmlogo.jpeg') }}" alt="logo" />
                        @if ($user->hasRole('admin'))
                        <h3 style="color:blue; font-size:20px; font-weight:800;">Admin<b style="color:black"> Panel</b></h3>
                        @else
                        <h3 style="color:blue; font-size:20px; font-weight:800;">User<b style="color:black"> Panel</b></h3>
                        @endif

                    </a>
                    <a class="navbar-brand brand-logo-mini" href="">
                        <img src="{{ url('public/admin/mlmlogo.jpeg') }}" alt="logo" />
                        {{-- <i class="menu-icon mdi mdi-church"></i> --}}
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">

                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block">

                    </li>
                    <li class="nav-item d-none d-lg-block">

                    </li>
                    <li class="nav-item">

                    </li>
                    @if ($user->hasRole('user'))
                    <li class="nav-item dropdown">
                        <b>Your Referral Code: {{ $user->referral_code }}</b>
                    </li>
                    @else
                    <li class="nav-item dropdown">

                    </li>
                    @endif
                    @if(!($user->hasRole('admin')))
                    <li class="nav-item dropdown">
                        <i class="fas fa-wallet"></i>
                        <span class="ml-2" style="font-weight: 900 !important"><b>{{ $user->wallet }}</b></span>
                    </li>
                    @endif
                    @if(!($user->hasRole('admin')))
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{route('user.change-password')}}">
                            <i class="fa-solid fa-key"></i>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal" role="button">
                            <i class="fas fa-power-off" id="logout-icon" style="cursor: pointer;"></i>
                        </a>
                    </li>


                </ul>

            </div>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
    </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
            <div id="settings-trigger"><i class="ti-settings"></i></div>
            <div id="theme-settings" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <p class="settings-heading">SIDEBAR SKINS</p>
                <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                    <div class="img-ss rounded-circle bg-light border me-3"></div>Light
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
                </div>
                <p class="settings-heading mt-2">HEADER SKINS</p>
                <div class="color-tiles mx-0 px-4">
                    <div class="tiles success"></div>
                    <div class="tiles warning"></div>
                    <div class="tiles danger"></div>
                    <div class="tiles info"></div>
                    <div class="tiles dark"></div>
                    <div class="tiles default"></div>
                </div>
            </div>
        </div>
        <div id="right-sidebar" class="settings-panel">
            <i class="settings-close ti-close"></i>
            <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
            </ul>
            <div class="tab-content" id="setting-content">
                <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">

                    <div class="list-wrapper px-3">

                    </div>

                    <div class="events pt-4 px-3">
                    </div>
                    <div class="events pt-4 px-3">

                    </div>
                </div>
                <!-- To do section tab ends -->
                <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                    <div class="d-flex align-items-center justify-content-between border-bottom">

                    </div>
                    <ul class="chat-list">

                    </ul>
                </div>

                <!-- chat tab ends -->
            </div>
        </div>

