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
							<div class="col-md-2">
								<label for="inputFirstName2" class="form-label">Inspector Name</label>
								<input type="text" name="email" class="form-control" readonly value="{{$data->user->name??''}}" id="inputFirstName2" required>
							</div>

							<div class="col-md-2">
								<label for="inputFirstName2" class="form-label">Hajeri Shed</label>
								<input type="text" name="email" class="form-control" readonly value="{{$data->barcode->hajeri->hajeri_shed??''}}" id="inputFirstName2" required>
							</div>

							<div class="col-md-3">
								<label for="inputState" class="form-label">Area Name</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->barcode->address}}" id="inputState">
							</div>

							<div class="col-md-3">
								<label for="inputState" class="form-label">Ward Name</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->barcode->ward->name??''}}" id="inputState">
							</div>

							<div class="col-md-2">
								<label for="inputState" class="form-label">Barcode ID</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->barcode_id}}" id="inputState">
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6" style="margin-top: 30px;">
								<h6>Section 1 Before Work</h6>
								<div class="row">
									<div class="col-md-6">
										@if($data->before_work!=null)
										<img src="{{config('app.baseURL')}}/storage/app/{{$data->before_work}}" style="width: 50%;">
										@endif
									</div>
									<div class="col-md-6">
										<label for="inputCity" class="form-label">Time</label>
										<input type="text" name="ponumber" class="form-control" readonly value="" id="inputCity">
										<label for="inputCity" class="form-label">Latitude + Longitude</label>
										<input type="text" name="ponumber" class="form-control" readonly value="{{$data->before_latlng}}" id="inputCity">
										<label for="inputCity" class="form-label">Remark</label>
										<input type="text" name="ponumber" class="form-control" readonly value="{{$data->remark}}" id="inputCity">
									</div>
								</div>
							</div>
							


							<div class="col-lg-6" style="margin-top: 30px;">
								<h6>Section 1 After Work</h6>
								<div class="row">
									<div class="col-md-6">
										@if($data->after_work!=null)
										<img src="{{config('app.baseURL')}}/storage/app/{{$data->after_work}}" style="width: 50%;">
										@endif
									</div>
									<div class="col-md-6">
										<label for="inputCity" class="form-label">Time</label>
										<input type="text" name="ponumber" class="form-control" readonly value="" id="inputCity">
										<label for="inputCity" class="form-label">Latitude + Longitude</label>
										<input type="text" name="ponumber" class="form-control" readonly value="{{$data->after_latlng}}" id="inputCity">
										<label for="inputCity" class="form-label">Remark</label>
										<input type="text" name="ponumber" class="form-control" readonly value="{{$data->remark}}" id="inputCity">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<!-- <label class="form-label">Section1 Before Work</label> -->
							
							<div class="col-md-6">
								<label for="inputState" class="form-label">Section1 After Latitude & Longitude</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->after_latlng}}" id="inputState">
							</div>
							<div class="col-md-6">
								<label for="inputCity" class="form-label">Section2 Before Latitude & Longitude</label>
								<input type="text" name="ponumber" class="form-control" readonly value="{{$data->section_before_latlng}}" id="inputCity" required>
							</div>
							<div class="col-md-6">
								<label for="inputState" class="form-label">Section2 After Latitude & Longitude</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->section_after_latlng}}" id="inputState">
							</div>

							<div class="col-md-6">
								<label for="inputCity" class="form-label">Section3 Before Latitude & Longitude</label>
								<input type="text" name="ponumber" class="form-control" readonly value="{{$data->section1_before_latlng}}" id="inputCity" required>
							</div>
							<div class="col-md-6">
								<label for="inputState" class="form-label">Section3 After Latitude & Longitude</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->section1_after_latlng}}" id="inputState">
							</div>

							<div class="col-md-12">
								<hr>
							</div>
							
							<div class="col-md-6">

							</div>
							<div class="col-md-6">
								<label for="inputState" class="form-label">Section2 Remark</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->section_remark}}" id="inputState">
							</div>
							<div class="col-md-6">
								<label for="inputState" class="form-label">Section3 Remark</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->section1_remark}}" id="inputState">
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
								<label for="inputState" class="form-label">Section1 After Work</label><br>
								@if($data->after_work!=null)
								<img src="{{config('app.baseURL')}}/storage/app/{{$data->after_work}}" style="width: 50%;">
								@endif
							</div>
							<div class="col-md-6">
								<label for="inputState" class="form-label">Section2 Before Work</label><br>
								@if($data->section_before_work!=null)
								<img src="{{config('app.baseURL')}}/storage/app/{{$data->section_before_work}}" style="width: 50%;">
								@endif
							</div>
							<div class="col-md-6">
								<label for="inputState" class="form-label">Section2 After Work</label><br>
								@if($data->section_after_work!=null)
								<img src="{{config('app.baseURL')}}/storage/app/{{$data->section_after_work}}" style="width: 50%;">
								@endif
							</div>

							<div class="col-md-6">
								<label for="inputState" class="form-label">Section3 Before Work</label><br>
								@if($data->section1_before_work!=null)
								<img src="{{config('app.baseURL')}}/storage/app/{{$data->section1_before_work}}" style="width: 50%;">
								@endif
							</div>
							<div class="col-md-6">
								<label for="inputState" class="form-label">Section3 After Work</label><br>
								@if($data->section1_after_work!=null)
								<img src="{{config('app.baseURL')}}/storage/app/{{$data->section1_after_work}}" style="width: 50%;">
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