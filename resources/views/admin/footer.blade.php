 <!-- partial:partials/_footer.html -->
 <footer class="footer">
     <div class="d-sm-flex justify-content-center justify-content-sm-between">
         {{-- <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.
         </span>
         <span class="float-none float-sm-left d-block mt-1 mt-sm-0 text-center"> Distributed By: <a href="https://themewagon.com/" target="_blank">ThemeWagon</a></span> --}}
         <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © {{ now()->format('Y') }}. All rights reserved.</span>
     </div>
 </footer>
 </div>
 <!-- partial -->
 </div>
 <!-- main-panel ends -->
 </div>
 <!-- page-body-wrapper ends -->
 </div>
 <!-- container-scroller -->
 <script>
     document.getElementById('logout-icon').addEventListener('click', function() {
         var confirmation = confirm("Are you sure you want to log out?");
         if (confirmation) {
             var form = document.createElement('form');
             form.method = 'POST';
             form.action = '{{ route("logout") }}';
             form.style.display = 'none'; // Hide the form

             // Create a CSRF token input field and add it to the form
             var csrfTokenField = document.createElement('input');
             csrfTokenField.type = 'hidden';
             csrfTokenField.name = '_token';
             csrfTokenField.value = '{{ csrf_token() }}';
             form.appendChild(csrfTokenField);

             document.body.appendChild(form);
             form.submit();
         }
     });
 </script>

 <!-- plugins:js -->
 <script src="{{ url('admin/vendors/js/vendor.bundle.base.js')}}"></script>
 <!-- endinject -->
 <!-- Plugin js for this page -->
 <script src="{{ url('admin/vendors/chart.js/Chart.min.js')}}"></script>
 <script src="{{ url('admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
 <script src="{{ url('admin/vendors/select2/select2.min.js')}}"></script>
 <script src="{{ url('admin/vendors/progressbar.js/progressbar.min.js')}}"></script>
 <script src="{{url('js/file-upload.js')}}"></script>

 <!-- End plugin js for this page -->
 <!-- inject:js -->
 <script src="{{ url('admin/js/off-canvas.js')}}"></script>
 <script src="{{ url('admin/js/hoverable-collapse.js')}}"></script>
 <script src="{{ url('admin/js/template.js')}}"></script>
 <script src="{{ url('admin/js/settings.js')}}"></script>
 <script src="{{ url('admin/js/select2.js')}}"></script>
 <script src="{{ url('admin/js/todolist.js')}}"></script>
 <!-- endinject -->
 <!-- Custom js for this page-->
 <script src="{{ url('admin/js/dashboard.js')}}"></script>
 <script src="{{ url('admin/js/Chart.roundedBarCharts.js')}}"></script>
 <!-- End custom js for this page-->
 </body>


 <!-- Mirrored from themewagon.github.io/star-admin2-free-admin-template/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Oct 2023 06:23:31 GMT -->

 </html>
