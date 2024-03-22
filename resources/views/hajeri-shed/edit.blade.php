@extends('layouts.app')
@section('content')
<style type="text/css">
	.form-label{
		margin-top: 10px;
	}
</style>
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
							<h5 class="mb-0 text-primary">Report Details</h5>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Customer Name</label>
								<input type="text" name="email" class="form-control" readonly value="{{$data->user->name}}" id="inputFirstName2" required>
							</div>
							<div class="col-md-6">
								<label for="inputFirstName3" class="form-label">Customer Contact Number</label>
								<input type="text" name="customer_contact_number" class="form-control" readonly value="{{$data->user->mobile_number}}" id="inputFirstName3" minlength="10" maxlength="10" required>
							</div>
							<div class="col-md-6">
								<label for="inputCity" class="form-label">Before Latitude & Longitude</label>
								<input type="text" name="ponumber" class="form-control" readonly value="{{$data->before_latlng}}" id="inputCity" required>
							</div>
							<div class="col-md-6">
								<label for="inputState" class="form-label">After Latitude & Longitude</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->after_latlng}}" id="inputState">
							</div>
							<div class="col-md-6">
								<label for="inputState" class="form-label">Address</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->barcode_detail}}" id="inputState">
							</div>
							<div class="col-md-6">
								<label for="inputState" class="form-label">Created At</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->created_at}}" id="inputState">
							</div>
							<div class="col-md-6">
								<label for="inputState" class="form-label">Updated At</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->updated_at}}" id="inputState">
							</div>
							<div class="col-md-12">
								<hr>
							</div>
							<div class="col-md-6">
								<label for="inputState" class="form-label">Before Work</label>
								@if($data->before_work!=null)
								<img src="{{config('app.baseURL')}}/storage/app/{{$data->before_work}}" style="width: 100%;">
								@endif
							</div>
							<div class="col-md-6">
								<label for="inputState" class="form-label">After Work</label>
								@if($data->after_work!=null)
								<img src="{{config('app.baseURL')}}/storage/app/{{$data->after_work}}" style="width: 100%;">
								@endif
							</div>
							
							<div class="col-md-12" style="margin-top:10px;">
								<button type="submit" onclick="history.back()" class="btn btn-outline-primary px-5">Back</button>
							</div>
						</div>
						
					</div>
				</div>


			</div>
		</div>

		<!--end row-->
	</div>
</div>
<!--end page wrapper -->
@endsection