@extends('layouts.app')
@section('content')
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<p align="right"><a href="{{config('app.baseURL')}}/machine/add" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>Add New Machine</a></p>
				<h6 class="mb-0 text-uppercase" style="display:inline-block;">All Machines</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sr.No</th>
										<th>Machine ID</th>
										<th>Machine Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($machine as $key=>$machine)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$machine->machine_id}}</td>
										<td>{{$machine->machine_name}}</td>
										<td>
											<div class="d-flex order-actions">
												<a href="{{config('app.baseURL')}}/machine/edit/{{$machine->id}}" class=""><i class='bx bxs-edit'></i></a>
												<a href="{{config('app.baseURL')}}/machine/delete/{{$machine->id}}" class="ms-3"><i class='bx bxs-trash'></i></a>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>Sr.No</th>
										<th>Machine ID</th>
										<th>Machine Name</th>
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