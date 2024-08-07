@extends('layouts.app')
@section('content')
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div style="width: 100%;display: flex;">
					<div style="width:50%">
					<h6 class="mb-0 text-uppercase" style="display:inline-block;">All HOD</h6>					
					</div>
					<div style="width:50%">
					<p align="right"><a href="{{route('admins.create')}}" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>Add New HOD</a></p>	
					</div>
				</div>
				<hr/>

				<div class="card">
					<div class="card-body">
						
						<div class="table-responsive">
							<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Name</th>
										<th>Email</th>
										<th>Mobile Number</th>
										<th>Designation</th>
										<th>Created At</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $key=>$data)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$data->name}}</td>
										<td>{{$data->email}}</td>
										<td>{{$data->contact_number ?? ''}}</td>
										<td>{{$data->designation?? '-'}}</td>
										<td>{{$data->created_at?->format('Y/m/d')}}</td>
										<td>@if($data->is_active==1)
											<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Active</div>
											@else
											<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Inactive</div>
											@endif
										</td>
										<td>
											<div class="d-flex order-actions">
												<a href="{{route('admins.edit',$data->id)}}" class=""><i class='bx bxs-edit'></i></a>
												{{-- <a href="{{route('admins.destroy',$data->id)}}"  class="ms-3"><i class='bx bxs-trash'></i></a> --}}
											</div>
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