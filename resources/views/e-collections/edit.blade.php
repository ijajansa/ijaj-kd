@extends('layouts.app')
@section('content')
	<!--plugins-->
    <link href="{{config('app.baseURL')}}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{config('app.baseURL')}}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />

<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">

		<div class="row">
			<div class="col-xl-12">
				<div class="card border-top border-0 border-4 border-primary">
					<div class="card-body p-5">
						<div class="card-title d-flex align-items-center">
							<div><i class="bx bx-edit me-1 font-22 text-primary"></i>
							</div>
							<h5 class="mb-0 text-primary" style="font-weight: bold;">Waste Request Details</h5>
						</div>
						<hr>
						<form class="row g-3" method="POST" action="{{route('waste-requests.update',$data->id)}}">
							@csrf
							@method('PATCH')
							<div class="col-md-3">
								<label for="inputFirstName2" class="form-label">Customer Name</label>
								<input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{old('name',$data->name)}}" disabled placeholder="Name">
								
							</div>
							<div class="col-md-3">
								<label for="inputFirstName2" class="form-label">Contact Number</label>
								<input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{old('name',$data->contact_number)}}" disabled placeholder="Name">
							</div>
							
							<div class="col-md-3">
								<label for="inputFirstName2" class="form-label">Ward</label>
								<input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{old('name',$data->ward)}}" disabled placeholder="Name">
								
							</div>
							<div class="col-md-3">
								<label for="inputFirstName2" class="form-label">Area</label>
								<input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{old('name',$data->area)}}" disabled placeholder="Name">
								
							</div>
							<div class="col-md-3">
								<label for="inputFirstName2" class="form-label">Address</label>
								<input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{old('name',$data->address)}}" disabled placeholder="Name">
					
							</div>
							<div class="col-md-3">
								<label for="inputFirstName2" class="form-label">Waste Type</label>
								<select class="form-control form-select @error('type') is-invalid @enderror" disabled name="type">
									<option value="1" @if($data->category_id==1) selected @endif>CND-Waste</option>
									<option value="2" @if($data->category_id==2) selected @endif>E-Waste</option>
								</select>
							</div>
							<div class="col-md-3">
								<label for="inputFirstName2" class="form-label">Assign Request To Employee</label>
								<select class="form-control form-select @error('type') is-invalid @enderror" required name="employee_id">
									<option value="">Select Employee</option>
									@foreach($employees as $employee)
									<option value="{{$employee->id}}" @if($data->employee_id==$employee->id) selected @endif>{{$employee->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-3">
								<label for="inputFirstName2" class="form-label">Request Status</label>
								<p>
									@if($data->status==1) 
									<h6 class="text-danger">New</h6> 
									@elseif($data->status==2) 
									<h6 class="text-success">Employee Assigned</h6> 
									@elseif($data->status==3) 
									<h6 class="text-warning">Processing</h6> 
									@elseif($data->status==4) 
									<h6 class="text-success">Completed</h6>  
									@else 
									<h6 class="text-danger">Rejected</h6> 
									@endif
								</p>
							</div>
							<div class="col-md-3">
								<button type="submit" class="btn btn-primary">Assign Employee</button>
							</div>

							<div class="col-12"><hr></div>
							@if(count($data->waste_items))
							<div class="col-lg-12">
								<h5 class="text-primary" style="font-weight: bold;margin-bottom:20px;">Waste Items</h5>
								<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
											<th>Sr No.</th>
											<th>Product</th>
											<th>Quantity</th>
											<th>Actual Quantity</th>
											<th>Created At</th>
										</tr>
									</thead>
									<tbody>
										@foreach($data?->waste_items as $key=>$record)
										<tr>
											<td>{{++$key}}</td>
											<td>{{$record?->name}}</td>
											<td>{{$record?->qty??0}}</td>
											<td>{{$record?->actual_qty??0}}</td>
											<td>{{$record?->created_at}}</td>
											
										</tr>
										@endforeach
									</tbody>
									
								</table>
							</div>
							@endif
								<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Update</button>
							</div>
						</form>
					</div>
				</div>


			</div>
		</div>

		<!--end row-->
	</div>
</div>


<!--end page wrapper -->

@endsection