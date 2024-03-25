@extends('layouts.app')
@section('content')
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div style="width: 100%;display: flex;">
					<div style="width:50%">
					<h6 class="mb-0 text-uppercase" style="display:inline-block;">All Employees</h6>					
					</div>
					<div style="width:50%">
					<p align="right"><a href="{{config('app.baseURL')}}/employee/add" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>Add New Employee</a></p>	
					</div>
				</div>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="row" style="justify-content: end">
							@if(auth()->user()->role_id==1)
								<div class="col-lg-3">
								<label class="">System User</label>
								<select id="user_id" required class="form-control form-select" onchange="getInspector(this.value)">
									<option value="">Select User</option>
									@foreach($users as $sys)
									<option value="{{$sys->id}}" @if(request()->get('user_id')==$sys->id) selected @endif>{{$sys->name}} {{" - ".$sys->category_name}}</option>
									@endforeach
								</select>
								</div>
							@else
								<input type="hidden" value="{{auth()->user()->id}}" id="user_id">
							@endif
							<div class="col-lg-3">
								<label>Select Inspector</label>
								<select id="inspector_id" required class="form-control form-select" id="inputCat">
									<option value="">Select Inspector</option>
									@foreach($inspectors as $inspector)
									<option value="{{$inspector->id}}" @if(request()->get('inspector_id')==$inspector->id) selected @endif>{{$inspector->name}}</option>
									@endforeach
								</select>
							</div>

							<div class="col-lg-2">
								<label style="opacity: 0;display:block">Select Inspector</label>
								<button type="button" class="btn btn-primary btn-block" onclick="applyFilter()" style="width: 100%">Apply Filter</button>
							</div>
						</div>
							<hr>
						<div class="table-responsive">
							<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Name</th>
										<th>Email</th>
										<th>Mobile Number</th>
										<th>Address</th>
										<th>Inspector Name</th>
										<th>Created At</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($user as $key=>$datas)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$datas->name??''}}</td>
										<td>{{$datas->email??''}}</td>
										<td>{{$datas->mobile_number??''}}</td>
										<td>{{$datas->address??''}}</td>
										<td>{{$datas->inspector->name??''}}</td>
										<td>{{$datas->updated_at->format('Y/m/d')}}</td>
										<td>@if($datas->is_active==1)
											<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Active</div>
											@else
											<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Inactive</div>
											@endif
										</td>
										<td>
											<div class="d-flex order-actions">
												<a href="{{config('app.baseURL')}}/employee/view/{{$datas->id}}" class=""><i class='bx bxs-edit'></i></a>
												<a href="{{config('app.baseURL')}}/employee/delete/{{$datas->id}}"  class="ms-3"><i class='bx bxs-trash'></i></a>
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
<script>
	function applyFilter()
	{
		inspector_id=$("#inspector_id").val();
		user_id=$("#user_id").val();
		window.location.href="{{config('app.baseURL')}}/employee/all?user_id="+user_id+"&inspector_id="+inspector_id;
	}

	$(document).ready(function(){
		user_id=$("#user_id").val();
		getInspector(user_id);
	});

	function getInspector(id)
	{
		if(id.length!=0)
		{
			$.ajax({
				url:"{{config('app.baseURL')}}/employee/getInspectors",
				type:'GET',
				data:{id:id},
				success:function(data)
				{
					$("#inspector_id").html(data);
				}
			});
		}
	}
</script>
@endsection