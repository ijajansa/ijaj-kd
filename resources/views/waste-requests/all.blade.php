@extends('layouts.app')
@section('content')
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div style="width: 100%;display: flex;">
					<div style="width:100%">
					<h6 class="mb-0 text-uppercase" style="display:inline-block;">Waste Requests</h6>					
					</div>
					{{-- <div style="width:50%">
					<p align="right"><a href="{{route('products.create')}}" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>Add New</a></p>	
					</div> --}}
				</div>
				<hr/>

				<div class="card">
					<div class="card-body">
						
						<div class="table-responsive">
							<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Customer Name</th>
										<th>Contact Number</th>
										<th>Ward</th>
										<th>Area</th>
										<th>Waste Type</th>
										<th>Status</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $key=>$record)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$record?->name}}</td>
										<td>{{$record?->contact_number}}</td>
										<td>{{$record?->ward}}</td>
										<td>{{$record?->area}}</td>
										<td>
											<div class="badge rounded-pill text-primary bg-light-primary p-2 text-uppercase px-3">{{$record->category_name}}</div>
										</td>
										<td>
											@if($record->status==1) 
											<h6 class="text-danger">New</h6> 
											@elseif($record->status==2) 
											<h6 class="text-success">Employee Assigned</h6> 
											@elseif($record->status==3) 
											<h6 class="text-warning">Processing</h6> 
											@elseif($record->status==4) 
											<h6 class="text-success">Completed</h6>  
											@else 
											<h6 class="text-danger">Rejected</h6> 
											@endif
										</td>
										<td>{{date('Y-m-d',strtotime($record->created_at))}}</td>
										<td>
											<div class="d-flex order-actions">
												<a href="{{route('waste-requests.edit',$record->uuid)}}" class=""><i class='bx bxs-edit'></i></a>
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