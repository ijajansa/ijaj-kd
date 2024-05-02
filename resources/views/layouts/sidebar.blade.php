<!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <!-- <div>
                    <img src="https://dsptechnologies.co.in/assets/title.png" class="logo-icon" alt="logo icon">
                </div> -->
                <div>
                    <img src="{{config('app.baseURL')}}/assets/images/vita-logo.png" style="width: 80%;
                    margin-top: 98px;
                    margin-left: 10%;" alt="" />
                </div>
                <!-- <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div> -->
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{config('app.baseURL')}}/home">
                        <div class="parent-icon"><i class='bx bx-home-circle'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                @if(auth()->user()->role_id==1)
                <li>
                    <a href="{{route('categories.index')}}">
                        <div class="parent-icon"><i class='bx bx-category'></i>
                        </div>
                        <div class="menu-title">All Category</div>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role_id==1)
                <li>
                    <a href="{{route('products.index')}}">
                        <div class="parent-icon"><i class='bx bx-cube'></i>
                        </div>
                        <div class="menu-title">Waste Products</div>
                    </a>
                </li>
                @endif
                <!-- <li class="menu-label">Details</li>
                <li>
                    <a href="{{config('app.baseURL')}}/hotel/all">
                        <div class="parent-icon"><i class='bx bx-plus'></i>
                        </div>
                        <div class="menu-title">About Hotel</div>
                    </a>
                </li>
                <li>
                    <a href="{{config('app.baseURL')}}/enquiry/all">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">View All Enquiry</div>
                    </a>
                </li>
                <li>
                    <a href="{{config('app.baseURL')}}/facilities/all">
                        <div class="parent-icon"><i class='bx bx-plus'></i>
                        </div>
                        <div class="menu-title">Add Facilities</div>
                    </a>
                </li> -->
                <!-- <li class="menu-label">Dashboard</li> -->
                <!-- <li>
                    <a href="{{config('app.baseURL')}}/customer/all">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">All Customer</div>
                    </a>
                </li> -->
               
                <li>
                    <a href="{{config('app.baseURL')}}/wards/all">
                        <div class="parent-icon"><i class='bx bx-menu'></i>
                        </div>
                        <div class="menu-title">All Wards</div>
                    </a>
                </li>
                <!-- <li>
                    <a href="{{config('app.baseURL')}}/hajeri-shed/all">
                        <div class="parent-icon"><i class='bx bx-file'></i>
                        </div>
                        <div class="menu-title">All Hajeri Shed</div>
                    </a>
                </li> -->
                <li>
                    <a href="{{config('app.baseURL')}}/barcode/all">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">All Areas</div>
                    </a>
                </li>

                 <li>
                    <a href="{{config('app.baseURL')}}/user/all">
                        <div class="parent-icon"><i class='bx bx-user'></i>
                        </div>
                        <div class="menu-title">All Inspector</div>
                    </a>
                </li>


                <li>
                    <a href="{{config('app.baseURL')}}/employee/all">
                        <div class="parent-icon"><i class='bx bx-user-plus'></i>
                        </div>
                        <div class="menu-title">All Employees</div>
                    </a>
                </li>
                @if(auth()->user()->role_id==1)
                <li>
                    <a href="{{route('admins.index')}}">
                        <div class="parent-icon"><i class='bx bx-user-plus'></i>
                        </div>
                        <div class="menu-title">All System User</div>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role_id==1)
                <li>
                    <a href="{{route('waste-requests.index')}}">
                        <div class="parent-icon"><i class='bx bx-receipt'></i>
                        </div>
                        <div class="menu-title">Waste Requests</div>
                    </a>
                </li>
                @endif

                <li>
                    <a href="{{config('app.baseURL')}}/report/all">
                        <div class="parent-icon"><i class='bx bx-menu'></i>
                        </div>
                        <div class="menu-title">Inspection Reports</div>
                    </a>
                </li>
                @if(auth()->user()->role_id==1)
                <li>
                    <a href="{{config('app.baseURL')}}/customers">
                        <div class="parent-icon"><i class='bx bx-user-circle'></i>
                        </div>
                        <div class="menu-title">Customers</div>
                    </a>
                </li>
                
                @endif



                
            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper 