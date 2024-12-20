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
                
                <li>
                    <a href="{{route('categories.index')}}">
                        <div class="parent-icon"><i class='bx bx-category'></i>
                        </div>
                        <div class="menu-title">All Category</div>
                    </a>
                </li>

                <li>
                    <a href="{{config('app.baseURL')}}/wards/all">
                        <div class="parent-icon"><i class='bx bx-menu'></i>
                        </div>
                        <div class="menu-title">All Wards</div>
                    </a>
                </li>
                
                <li>
                    <a href="{{config('app.baseURL')}}/barcode/all">
                        <div class="parent-icon"><i class='bx bx-folder'></i>
                        </div>
                        <div class="menu-title">QR Code Generator</div>
                    </a>
                </li>

                

                <li>
                    <a href="{{config('app.baseURL')}}/report/all">
                        <div class="parent-icon"><i class='bx bx-menu'></i>
                        </div>
                        <div class="menu-title">Inspection Reports</div>
                    </a>
                </li>
                
                <li>
					<a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
						<div class="parent-icon"><i class="bx bx-user-plus"></i>
						</div>
						<div class="menu-title">Employee Section</div>
					</a>
					<ul class="mm-collapse">
						<li> <a href="{{config('app.baseURL')}}/user/all"><i class="bx bx-user"></i>All HOD</a>
						</li>
						<li> <a href="{{config('app.baseURL')}}/employee/all"><i class="bx bx-user-plus"></i>All Supervisor</a>
						</li>
						@if(auth()->user()->role_id==1)
						<li> <a href="{{config('app.baseURL')}}/admins"><i class="bx bx-user"></i>Subadmin</a>
						</li>
						@endif
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
						<div class="parent-icon"><i class="bx bx-cube"></i>
						</div>
						<div class="menu-title">Waste Manageme.</div>
					</a>
					<ul class="mm-collapse">
						<li> <a href="{{route('products.index')}}"><i class="bx bx-radio-circle"></i>Waste Products</a>
						</li>
						<li> <a href="{{route('waste-requests.index')}}"><i class="bx bx-radio-circle"></i>Waste Requests</a>
						</li>
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
						<div class="parent-icon"><i class="bx bx-folder"></i>
						</div>
						<div class="menu-title">C&D Report</div>
					</a>
					<ul class="mm-collapse">
						<li> <a href="{{url('cd-collections')}}"><i class="bx bx-user"></i>All Collection</a>
						</li>
						<li> <a href="{{url('cd-processed/add')}}"><i class="bx bx-user-plus"></i>Add New Processing</a>
						</li>
						<li> <a href="{{url('cd-processed')}}"><i class="bx bx-user-plus"></i>All Processed</a>
						</li>
					</ul>
				</li>
				<li>
					<a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
						<div class="parent-icon"><i class="bx bx-folder"></i>
						</div>
						<div class="menu-title">E-Waste Report</div>
					</a>
					<ul class="mm-collapse">
						<li> <a href="{{url('e-collections')}}"><i class="bx bx-user"></i>All Collection</a>
						</li>
						<li> <a href="{{url('e-processed/add')}}"><i class="bx bx-user-plus"></i>Add New Processing</a>
						</li>
						<li> <a href="{{url('e-processed')}}"><i class="bx bx-user-plus"></i>All Processed</a>
						</li>
					</ul>
				</li>
                


                
            </ul>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper 