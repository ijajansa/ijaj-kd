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
					<div style="display:flex;width: 100%;">
						<div style="width: 50%;">
							<h6 class="mb-0 text-uppercase" style="display:inline-block;">All Hajeri Shed</h6>				
						</div>
						<div style="width: 50%;">
							<p align="right" style="margin:0;padding: 0;"><a  data-bs-toggle="modal" data-bs-target="#exampleLargeModal" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-spreadsheet'></i>Add Hajeri Shed</a></p>		
						</div>
					</div>
					<hr/>

					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>Sr. No</th>
											<th>Hajeri Shed</th>
											<th>Ward Name</th>
											<th>Status</th>
											<th>Created Date</th>
											<th>Action</th>
										</tr>
										
									</thead>
									<tbody>
										@foreach($datas as $key=>$data)
										<tr>
											<td>{{++$key}}</td>
											<td>{{$data->hajeri_shed??''}}</td>
											<td>{{$data->ward->name??''}}</td>
											<td>
												@if($data->is_active==1)
												<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Active</div>
												@else
												<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Inactive</div>
												@endif
											</td>
											<td>{{$data->created_at->format('d-m-Y')}}</td>
											<td><a href="{{config('app.baseURL')}}/hajeri-shed/edit/{{$data->id}}"><button class="btn btn-primary"><i class="bx bxs-edit" style="margin-right: 0px;"></i></button></a>&nbsp;&nbsp;<a href="{{config('app.baseURL')}}/hajeri-shed/delete/{{$data->id}}"><button class="btn btn-danger"><i class="bx bxs-trash" style="margin-right: 0px;"></i></button></a></td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>



<!-- Modal -->
<div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="POST" action="{{config('app.baseURL')}}/hajeri-shed/add" enctype="multipart/form-data">
				@csrf
			<div class="modal-header">
				<h5 class="modal-title">Add Hajeri Shed</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xl-12">
						<label class="form-label blog-label">Hajeri Shed</label>
						<input type="text" name="hajeri_shed" required placeholder="Hajeri Shed" class="form-control">
					</div>
					<div class="col-xl-12" style="margin-top: 10px;">
						<label class="form-label blog-label">Select Ward</label>
						<select class="form-control form-select" name="ward_id" required>
							<option value="">Select</option>
							@foreach($wards as $ward)
							<option value="{{$ward->id}}">{{$ward->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Add</button>
			</div>
		</form>
		</div>
	</div>
</div>




			
@endsection