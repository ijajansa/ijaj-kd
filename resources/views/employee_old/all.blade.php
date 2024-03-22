@extends('layouts.app')
@section('content')
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<h6 class="mb-0 text-uppercase" style="display:inline-block;">All Employee</h6>
				<p align="right"><a href="{{config('app.baseURL')}}/employee/add" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>Add Employee</a></p>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Mobile Number</th>
										<th>Designation</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($user as $key=>$user)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$user->name}}</td>
										<td>{{$user->email}}</td>
										<td>{{$user->mobile_number}}</td>
										<td>{{$user->role->name}}</td>
										<td>
											<div class="d-flex order-actions">
												<a href="{{config('app.baseURL')}}/employee/edit/{{$user->id}}" class=""><i class='bx bxs-edit'></i></a>
												<a href="{{config('app.baseURL')}}/employee/delete/{{$user->id}}" class="ms-3"><i class='bx bxs-trash'></i></a>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Mobile Number</th>
										<th>Designation</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<!--end page wrapper -->
@endsection