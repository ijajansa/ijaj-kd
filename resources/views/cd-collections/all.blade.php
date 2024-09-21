@extends('layouts.app')
@section('content')
{{$total = 0}}
@foreach($data as $key=>$record)
									@php
									$total += $record?->request_cd_items_sum_actual_qty;
									@endphp
									@endforeach
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div style="width: 100%;display: flex;">
					<div style="width:100%">
					<h6 class="mb-0 text-uppercase" style="display:inline-block;">All Collections Report</h6>					
					</div>
					<div style="width:50%">
					<p align="right"><a href="#" class="btn btn-primary mb-3 mb-lg-0">Total C&D Collected in (MT) : {{$total}}</a></p>	
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
										<th>Date</th>
										<th>Enquiry ID</th>
										<th>Person Name</th>
										<th>Mobile Number</th>
										<th>Address</th>
										<th>Ward</th>
										<th>C&D Collected in MT</th>
										<!--<th>Action</th>-->
									</tr>
								</thead>
								<tbody>

								    
									@foreach($data as $key=>$record)
									<tr>
										<td>{{++$key}}</td>
										<td>{{date('d-m-Y',strtotime($record->created_at))}}</td>
										<td>{{$record?->uuid}}</td>
										<td>{{$record?->name}}</td>
										<td>{{$record?->contact_number}}</td>
										<td>{{$record?->area}}</td>
										<td>{{$record?->ward}}</td>
										<td>{{$record?->request_cd_items_sum_actual_qty}}</td>
                                        <!--<td>View Details</td>-->
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