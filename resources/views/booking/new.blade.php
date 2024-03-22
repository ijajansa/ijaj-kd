@extends('layouts.app')
@section('content')
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<h6 class="mb-0 text-uppercase" style="display:inline-block;">New Booking</h6>
		<!-- <p align="right"><a href="{{config('app.baseURL')}}/booking/add" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>Add Booking</a></p> -->
		<hr/>

		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>Sr. No</th>
								<th>Name</th>
								<th>Email</th>
								<th>Mobile Number</th>
								<th>Booking Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $key=>$user)
							<tr>
								<td>{{++$key}}</td>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->mobile_number}}</td>
								<td>{{$user->booking_date}}</td>
								<td>
									<a href="{{config('app.baseURL')}}/booking/edit/{{$user->id}}"> <button class="btn btn-success" style="font-size: 14px;"><i style="font-size:18px;" class='bx bxs-edit'></i> View Details</button></a>
									<!-- <a href="{{config('app.baseURL')}}/booking/delete/{{$user->id}}" class="ms-3"><i class='bx bxs-trash'></i></a> -->
								</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Sr. No</th>
								<th>Name</th>
								<th>Email</th>
								<th>Mobile Number</th>
								<th>Booking Date</th>
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