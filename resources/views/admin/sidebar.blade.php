      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      @php
      $user = Auth::user();
      @endphp
      @if ($user->hasRole('admin'))
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.dashboard') }}">
                      <i class="mdi mdi-grid-large menu-icon"></i>
                      <span class="menu-title">Dashboard</span>
                  </a>
              </li>
              <li class="nav-item nav-category">E-Pin</li>
              <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                      <i class="menu-icon mdi mdi-floor-plan"></i>
                      <span class="menu-title">E-pin</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="collapse" id="ui-basic">
                      <ul class="nav flex-column sub-menu">
                          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.epin.index') }}">Epin
                                  Generation</a></li>
                          <li class="nav-item"> <a class="nav-link" href="{{ route('admin.transfer.index') }}">Epin
                                  Transfer</a></li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item nav-category">Transaction</li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.transactionHistory.index') }}">
                      <i class="menu-icon mdi mdi-cash"></i>
                      <span class="menu-title">Admin Transaction</span>
                  </a>
              </li>

              <li class="nav-item nav-category">User</li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('admin.user.index') }}">
                      <i class="menu-icon mdi mdi-account-circle"></i>
                      <span class="menu-title">Add User</span>
                  </a>
              </li>
                  <li class="nav-item nav-category">Withdraw</li>

                  <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-withdraw" aria-expanded="false" aria-controls="ui-basic">
                          <i class="menu-icon mdi mdi-floor-plan"></i>
                          <span class="menu-title">Withdraw Request</span>
                          <i class="menu-arrow"></i>
                      </a>
                      <div class="collapse" id="ui-basic-withdraw">
                          <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.withdrawRequest') }}">Request</a></li>
                              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.withdrawAccept') }}">Accept</a></li>
                              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.withdrawReject') }}">Reject</a></li>
                          </ul>
                      </div>
                  </li>
                  <li class="nav-item nav-category">Reports</li>

                  <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-report" aria-expanded="false" aria-controls="ui-basic">
                          <i class="menu-icon mdi mdi-floor-plan"></i>
                          <span class="menu-title">Reports</span>
                          <i class="menu-arrow"></i>
                      </a>
                      <div class="collapse" id="ui-basic-report">
                          <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.report.member') }}">Register Report</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.report.transfer') }}">Transfer Report</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.report.request') }}">Withdraw Request Report</a></li>
                              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.report.accept') }}">Withdraw Accept Report</a></li>
                              <li class="nav-item"> <a class="nav-link" href="{{ route('admin.report.reject') }}">Withdraw Reject Report</a></li>
                          </ul>
                      </div>
                  </li>

              <!-- <li class="nav-item nav-category">Forms and Datas</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                    <i class="menu-icon mdi mdi-card-text-outline"></i>
                    <span class="menu-title">Form elements</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="form-elements">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                    <i class="menu-icon mdi mdi-chart-line"></i>
                    <span class="menu-title">Charts</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="charts">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                    <i class="menu-icon mdi mdi-table"></i>
                    <span class="menu-title">Tables</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="tables">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                    <i class="menu-icon mdi mdi-layers-outline"></i>
                    <span class="menu-title">Icons</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="icons">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">pages</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="menu-icon mdi mdi-account-circle-outline"></i>
                    <span class="menu-title">User Pages</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">help</li>
            <li class="nav-item">
                <a class="nav-link" href="http://bootstrapdash.com/demo/star-admin2-free/docs/documentation.html">
                    <i class="menu-icon mdi mdi-file-document"></i>
                    <span class="menu-title">Documentation</span>
                </a>
            </li> -->
          </ul>
      </nav>
      @else
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('user.dashboard') }}">
                      <i class="mdi mdi-grid-large menu-icon"></i>
                      <span class="menu-title">Dashboard</span>
                  </a>
              </li>
              <li class="nav-item nav-category">E-Pin</li>
              <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                      <i class="menu-icon mdi mdi-floor-plan"></i>
                      <span class="menu-title">E-pin</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="collapse" id="ui-basic">
                      <ul class="nav flex-column sub-menu">
                          <li class="nav-item"> <a class="nav-link" href="{{ route('user.epin.index') }}">Epin
                                  List</a></li>
                      </ul>
                  </div>
              </li>
              <li class="nav-item nav-category">User</li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('user.user.index') }}">
                      <i class="menu-icon mdi mdi-account-circle"></i>
                      <span class="menu-title">Users</span>
                  </a>
              </li>

              <li class="nav-item nav-category">Transaction</li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('user.withdrawl.index') }}">
                      <i class="menu-icon mdi mdi-cash"></i>
                      <span class="menu-title">Withdrawl Payment</span>
                  </a>
              </li>

              <li class="nav-item nav-category">Tree Structure</li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('user.tree') }}">
                      <i class="menu-icon mdi mdi-cash"></i>
                      <span class="menu-title">Tree View</span>
                  </a>
              </li>
              <li class="nav-item nav-category">Reports</li>

              <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic-report" aria-expanded="false" aria-controls="ui-basic">
                      <i class="menu-icon mdi mdi-floor-plan"></i>
                      <span class="menu-title">Reports</span>
                      <i class="menu-arrow"></i>
                  </a>
                  <div class="collapse" id="ui-basic-report">
                      <ul class="nav flex-column sub-menu">
                          <li class="nav-item"> <a class="nav-link" href="{{ route('user.report.accept') }}">Withdraw Accept Report</a></li>
                          <li class="nav-item"> <a class="nav-link" href="{{ route('user.report.reject') }}">Withdraw Reject Report</a></li>
                      </ul>
                  </div>
              </li>

          </ul>
      </nav>
      @endif
