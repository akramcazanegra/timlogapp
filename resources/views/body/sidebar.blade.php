<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('backend/assets/images/users/user-1.jpg') }}" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

              

                <li class="menu-title">Navigation</li>
    
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboards </span>
                    </a>
                </li>

              
                
                <li class="menu-title mt-2">Apps</li>

                <li>
                    <a href="#sidebarEmployee" data-bs-toggle="collapse">
                    <i class="mdi mdi-account-multiple-outline"></i> <!-- Updated Icon -->
                        <span>Employee  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmployee">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.employee') }}">All employee</a>
                            </li>
                            <li>
                                <a href="{{ route('add.employee') }}">Add employee</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarSalary" data-bs-toggle="collapse">
                    <i class="mdi mdi-currency-usd"></i> <!-- Updated Icon -->
                        <span>Employee salary </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSalary">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.salary') }}">All salary</a>
                            </li>
                            <li>
                                <a href="{{ route('add.salary') }}">Add salary</a>
                            </li>
                           
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#attendence" data-bs-toggle="collapse">
                    <i class="mdi mdi-calendar-check"></i> <!-- Updated Icon -->
                        <span>Employee attendance </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="attendence">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('employee.attend.list') }}">Employee attend</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarCustomer" data-bs-toggle="collapse">
                    <i class="mdi mdi-account-group"></i> <!-- Updated Icon -->
                        <span>Customer  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCustomer">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.customer') }}">All customer</a>
                            </li>
                            <li>
                                <a href="{{ route('add.customer') }}">Add customer</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarSupplier" data-bs-toggle="collapse">
                    <i class="mdi mdi-account-tie"></i> <!-- Updated Icon -->
                        <span>instructor </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSupplier">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.supplier') }}">All instructor</a>
                            </li>
                            <li>
                                <a href="{{ route('add.supplier') }}">Add instructor</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarcategory" data-bs-toggle="collapse">
                    <i class="mdi mdi-tag-multiple"></i> <!-- Updated Icon -->
                        <span>category  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarcategory">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.category') }}">All category</a>
                            </li>
                            <li>
                                <a href="{{ route('add.category') }}">Add category</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarproduct" data-bs-toggle="collapse">
                    <i class="mdi mdi-train"></i> <!-- Updated Icon -->
                        <span>training </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarproduct">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.product') }}">All training</a>
                            </li>
                            <li>
                                <a href="{{ route('add.product') }}">Add training</a>
                            </li>
                
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarexpense" data-bs-toggle="collapse">
                    <i class="mdi mdi-cash-multiple"></i> <!-- Updated Icon -->
                        <span>expense  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarexpense">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('add.expense') }}">Add expense</a>
                            </li>
                            <li>
                                <a href="{{ route('today.expense') }}">Today expense </a>
                            </li>
                            <li>
                                <a href="{{ route('month.expense') }}">Monthly expense</a>
                            </li>
                            <li>
                                <a href="{{ route('year.expense') }}">Yearly expense</a>
                            </li>
                        </ul>
                    </div>
                </li>
               
                <li>
                    <a href="#sidebarroles" data-bs-toggle="collapse">
                    <i class="mdi mdi-shield-account"></i> <!-- Updated Icon -->

                        <span>Roles and permission </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarroles">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.permission') }}">All permission</a>
                            </li>

                            <li>
                                <a href="{{ route('all.roles') }}">All roles</a>
                            </li>

                            <li>
                                <a href="{{ route('add.roles.permission') }}">Roles in permission</a>
                            </li>

                            <li>
                                <a href="{{ route('all.roles.permission') }}">All Roles in permission</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>

                
                <li>
                    <a href="#admin" data-bs-toggle="collapse">
                    <i class="mdi mdi-cog-outline"></i> <!-- Updated Icon -->
                        <span>Setting admin </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="admin">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('all.admin') }}">All admin</a>
                            </li>

                            <li>
                                <a href="{{ route('add.admin') }}">Add admin</a>
                            </li>
                        </ul>
                    </div>
                </li>

                

                </ul>
                </div>
                </li>


            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>