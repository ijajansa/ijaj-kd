@extends('layouts.app')
@section('content')

		<div class="page-wrapper" style="margin-bottom: 0px !important;">
			<div class="page-content">
				<div class="row">
					<div class="col-xl-12">
						<div class="card border-top border-0 border-4 border-primary">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user-plus me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary">Add Facility</h5>
								</div>
								<hr>
								<form method="POST" action="{{config('app.baseURL')}}/facilities/add" class="row g-3">
									@csrf
									<div class="col-12">
										<label for="inputLastName1" class="form-label">Facility Name</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
											<input type="text" class="form-control border-start-0" id="inputLastName1" placeholder="Facility Name" name="name" required />
										</div>
									</div>
									
									<div class="col-12">
										<button type="submit" class="btn btn-primary px-5">Add</button>
									</div>
								</form>
							</div>
						</div>
						
					</div>
				</div>
				<!--end row-->
				
			</div>
		</div>
		



<!--start page wrapper -->
		<div class="page-wrapper" style="margin-top:10px;">
			<div class="page-content">
				<h6 class="mb-0 text-uppercase" style="display:inline-block;">All Facilities</h6>

				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $key=>$fac)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$fac->name}}</td>
										<td>
										@if($fac->is_active==1)
										<a href="{{config('app.baseURL')}}/facilities/status/{{$fac->id}}/0" class="btn btn-success ms-3">Activated</a>
										@else
										<a href="{{config('app.baseURL')}}/facilities/status/{{$fac->id}}/1" class="btn btn-danger ms-3">Inactive</a>
										@endif
										</td>
										
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<!--end page wrapper -->
@endsection