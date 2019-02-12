<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{url('/')}}" class="site_title"><i class="fa fa-paw"></i> <span>Lamassu</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{!! asset('files/'.\Auth::user()->picture) !!}" alt="..." class="img-circle profile_img">
            </div>
            <div style="text-align: center" class="profile_info">
                <span>   Welcome,</span>
                <h2>{{\Auth::user()->name}}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Invoice <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/invoiceAdd')}}">Add Invoice</a></li>
                            <li><a href="{{url('/')}}">Manage Invoice</a></li>
                            <li><a href="{{url('/invoiceTypeAdd')}}">Add Invoice Type</a></li>
                            <li><a href="{{url('/invoiceType')}}">Manage Invoice Type</a></li>

                            <li><a href="{{url('/writeHelperAdd')}}">Add Write Helper</a></li>
                            <li><a href="{{url('/manageWriteHelper')}}">Manage Write Helper</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-users"></i> Clients <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/addClient')}}">Add Clients</a></li>
                            <li><a href="{{url('/clientManagement')}}">Manage Clients</a></li>
                            <li><a href="{{url('/clientSpecialtyAdd')}}">Add Client Specialty</a></li>
                            <li><a href="{{url('/clientSpecialtyManagement')}}">Manage Client Specialty</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-credit-card"></i> Payment Method <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/paymentMethodAdd')}}">Add Payment Method</a></li>
                            <li><a href="{{url('/paymentMethod')}}">Manage Payment Method</a></li>
                        </ul>
                    </li>
                    @if(Auth::user()->roles()->first()->name == 'Admin')
                    <li><a><i class="fa fa-user-md"></i>Employee<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/employeeAdd')}}">Add Employee</a></li>
                            <li><a href="{{url('/employeeManage')}}">Manage Employee</a></li>
                            <li><a href="{{url('/departmentAdd')}}">Add Department</a></li>
                            <li><a href="{{url('/departmentManage')}}">Manage Department</a></li>
                            <li><a href="{{url('/monthSalaryAdd')}}">Add Month Salary</a></li>
                            <li><a href="{{url('/monthSalaryManage')}}">Manage Month Salary</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-chevron-circle-down"></i>Expenses<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/expensesAdd')}}">Add Expenses</a></li>
                            <li><a href="{{url('/expensesManage')}}">Manage Expenses</a></li>
                            <li><a href="{{url('/expensesTypeAdd')}}">Add Expenses Type</a></li>
                            <li><a href="{{url('/expensesTypeManage')}}">Manage Expenses Type</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-print"></i>Printing<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/printingAdd')}}">Add Printing</a></li>
                            <li><a href="{{url('/printingManage')}}">Manage Printing</a></li>
                            <li><a href="{{url('/printingCompanyAdd')}}">Add Printing Company</a></li>
                            <li><a href="{{url('/printingCompanyManage')}}">Manage Printing Company</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-pinterest-square"></i>Promotion Item<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/promotionItemAdd')}}">Add Promotion Item</a></li>
                            <li><a href="{{url('/promotionItemManage')}}">Manage Promotion Item</a></li>
                            <li><a href="{{url('/companyAddPage')}}">Add Promotion Item Company</a></li>
                            <li><a href="{{url('/promotionItemCompanyManage')}}">Manage Promotion Item Company</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-car"></i>Delivery<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/deliveryAdd')}}">Add Delivery Info. </a></li>
                            <li><a href="{{url('/deliveryManage')}}">Manage Delivery Info. </a></li>
                            <li><a href="{{url('/deliveryTypeAdd')}}">Add Delivery Type </a></li>
                            <li><a href="{{url('/deliveryTypeManage')}}">Manage Delivery Type </a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-book"></i>Debt<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/debtAdd')}}">Add Debt </a></li>
                            <li><a href="{{url('/debtManage')}}">Manage Debt Info. </a></li>
                            <li><a href="{{url('/debtNameAdd')}}">Add Creditor </a></li>
                            <li><a href="{{url('/debtNameManage')}}">Manage Creditors </a></li>
                            <li><a href="{{url('/debtPaidManage')}}">Manage Paid Debt </a></li>
                        </ul>
                    </li>
                        <li><a><i class="fa fa-credit-card"></i>Applications<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{url('/projectAdd')}}">Add Application</a></li>
                                <li><a href="{{url('/projectManage')}}">Manage Application</a></li>
                                <li><a href="{{url('/projectTypeAdd')}}">Add Application Type</a></li>
                                <li><a href="{{url('/projectTypeManage')}}">Manage Application Type</a></li>
                            </ul>
                        </li>
                    <li><a><i class="fa fa-edit"></i>Analysis<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/analysis')}}">Analysis</a></li>
                            <li><a href="{{url('/profitChart')}}">Profit Chart</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-user"></i>Admin<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/register')}}">Add User</a></li>
                            <li><a href="{{url('/userManage')}}">Manage User</a></li>
                        </ul>
                    </li>
                        @endif
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->

        <!-- /menu footer buttons -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{!! asset('files/'.\Auth::user()->picture) !!}" alt=""><b> {{\Auth::user()->name}}</b>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
 <li><a href="{{url('passwordEdit')}}"><i class="fa fa-key pull-right"></i> Change Password</a></li>
                        <li><a href="{{url('userPictureEdit')}}"><i class="fa fa-picture-o pull-right"></i> Change picture</a></li>
                        <li><a href="{{url('logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>


            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
