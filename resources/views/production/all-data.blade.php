@extends('layouts.app')
@section('content')
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<h6 class="mb-0 text-uppercase" style="display:inline-block;">Order In Production</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Accepted Date</th>
										<th>Customer Name</th>
										<th>Label/Ribbon Size</th>
										<th>Machine Name</th>
										<th>Operator Name</th>
										<th>Job Card</th>
										<th>Order Status</th>
										<!-- <th>View</th> -->
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($production as $key=>$production)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$production->created_at}}</td>
										
										<td>{{$production->order->customer->customer_name}}</td>
										<td>{{$production->order->label_size}}{{$production->order->label_type1}} X {{$production->order->label_size1}}{{$production->order->label_type2}}</td>
										<td>{{$production->machine->machine_name}}</td>
										<td>{{$production->employee->name}}</td>
										<td>{{$production->job_card}}</td>
										<td>
											
											@if($production->order->order_status==1)
											<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Pending</div>
											@elseif($production->order->order_status==2)
											<div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Processing</div>
											@else
											<div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Checking</div>
											@endif
										</td>
										
<!-- 										<td>
											<a href="{{config('app.baseURL')}}/production/view/{{$production->production_id}}"><button type="button" class="btn btn-primary btn-sm  px-4">View Details</button></a>
										</td> -->
										<td>
											<a href="{{config('app.baseURL')}}/production/production-view/{{$production->production_id}}"><button type="button" class="btn btn-danger btn-sm  px-4">View Production</button></a>
										</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>Sr No.</th>
										<th>Accepted Date</th>
										<th>Customer Name</th>
										<th>Label/Ribbon Size</th>
										<th>Machine Name</th>
										<th>Operator Name</th>
										<th>Job Card</th>
										<th>Order Status</th>
										<!-- <th>View</th> -->
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