@extends('layouts.app')
@section('content')
<style type="text/css">
	#example_filter{
		display: none;
	}
</style>
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div style="width: 100%;display: flex;">
					<div style="width:50%">
					<h6 class="mb-0 text-uppercase" style="display:inline-block;">All Area</h6>					
					</div>
					<div style="width:50%">
					<p align="right"><a href="{{config('app.baseURL')}}/barcode/add" class="btn btn-primary mb-lg-0"><i class='bx bxs-plus-square'></i>New Area</a>&nbsp;&nbsp;<a href="{{config('app.baseURL')}}/barcode/print-all" class="btn btn-danger mb-lg-0"><i class='bx bxs-download'></i>Print All</a></p>	
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
										<th>Address</th>
										<th>Ward Name</th>
										@if(auth()->user()->role_id==1)
										<th>System User</th>
										@endif
										<th>QR Code</th>
										<th>Print</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									
									@foreach($data as $key=>$datas)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$datas->address}}</td>
										<td>{{$datas->ward->name ?? '-'}}</td>
										@if(auth()->user()->role_id==1)
										<td>{{$datas?->user?->name ?? '-'}}</td>
										@endif
										<td>
										  {{"QR Code"}}
										</td>
										<td>
											<div class="d-flex order-actions">
												<form method="POST" action="{{config('app.baseURL')}}/barcode/print/{{$datas->id}}/{{$datas->address}}">
												@csrf
												<button type="submit" class="btn btn-primary btn-sm px-4">Print</button>
												</form>
											</div>
										</td>
										<td>
											<div class="d-flex order-actions">
									
												<a href="{{config('app.baseURL')}}/barcode/delete/{{$datas->id}}" class="ms-3"><i class='bx bxs-trash text-danger'></i></a>
												
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