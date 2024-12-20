			@extends('layouts.app')
			@section('content')
			<style type="text/css">
				#example_filter{
					display: none;
				}
			</style>
			<script type="text/javascript">
				function blockSpecialChar(e) {
					var k = e.keyCode;
					return (
						(k >= 65 && k <= 90) ||  // A-Z
						(k >= 97 && k <= 122) || // a-z
						k === 8 ||               // Backspace
						(k >= 48 && k <= 57) ||  // 0-9
						k === 32                 // Space
					);
				}
			</script>
			<!--start page wrapper -->
			<div class="page-wrapper">
				<div class="page-content">
					<div style="display:flex;width: 100%;">
						<div style="width: 50%;">
							<h6 class="mb-0 text-uppercase" style="display:inline-block;">All Wards</h6>				
						</div>
						<div style="width: 50%;">
							<p align="right" style="margin:0;padding: 0;"><a  data-bs-toggle="modal" data-bs-target="#exampleLargeModal" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-spreadsheet'></i>Add New Ward</a></p>		
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
											<th>Ward Number</th>											
											<th>Status</th>
											<th>Created Date</th>
											<th>Action</th>
										</tr>
										
									</thead>
									<tbody>
										@foreach($datas as $key=>$data)
										<tr>
											<td>{{++$key}}</td>
											<td>{{$data->ward_number??'-'}}</td>
											<!--@if(auth()->user()->role_id==1)-->
											<!--<td>{{$data?->user?->name ?? '-'}}</td>-->
											<!--@endif-->
											<td>
												@if($data->is_active==1)
												<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Active</div>
												@else
												<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Inactive</div>
												@endif
											</td>
											<td>{{$data->created_at->format('d-m-Y')}}</td>
											<td><a href="{{config('app.baseURL')}}/wards/edit/{{$data->id}}"><button class="btn btn-primary btn-sm"><i class="bx bxs-edit" style="margin-right: 0px;"></i></button></a>
											@if(auth()->user()->role_id==1)&nbsp;&nbsp;<a href="{{config('app.baseURL')}}/wards/delete/{{$data->id}}"><button class="btn btn-danger btn-sm"><i class="bx bxs-trash" style="margin-right: 0px;"></i></button></a>@endif</td>
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
			<form method="POST" action="{{config('app.baseURL')}}/wards/add" enctype="multipart/form-data">
				@csrf
			<div class="modal-header">
				<h5 class="modal-title">Add New Ward</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<!--@if(auth()->user()->role_id==1)-->
					<!--<div class="col-xl-12">-->
					<!--	<label class="form-label blog-label">System User</label>-->
					<!--	<select name="user_id" required class="form-control form-select @error('user_id') is-invalid @enderror" id="inputCat">-->
					<!--		<option value="">Select User</option>-->
					<!--		@foreach($users as $user)-->
					<!--		<option value="{{$user->id}}" @if(old('user_id')==$user->id) selected @endif>{{$user->name}} {{" - ".$user->category_name}}</option>-->
					<!--		@endforeach-->
					<!--	</select>-->
					<!--	@error('user_id')-->
					<!--	<span class="invalid-feedback" role="alert">-->
					<!--		<strong>{{ $message }}</strong>-->
					<!--	</span>-->
					<!--	@enderror-->
					<!--</div>-->
					<!--@else-->
					<!--<input type="hidden" value="{{auth()->user()->id}}" name="user_id">-->
					<!--@endif-->
					<div class="col-xl-12 mt-2">
						<label class="form-label blog-label">Ward Number</label>
						<input type="text" name="ward_number" required placeholder="Ward Number" class="form-control" onkeypress="return blockSpecialChar(event)">
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