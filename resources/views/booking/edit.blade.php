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
								<input type="text" name="email" class="form-control" readonly @if($data->user->role_id==2) value="{{$data->mukadam->name??''}}" @else  value="{{$data->user->name??''}}"  @endif id="inputFirstName2" required>
							</div>

							@if($data->user->role_id==2)
							<div class="col-md-2">
								<label for="inputFirstName2" class="form-label">Mukadam Name</label>
								<input type="text" name="email" class="form-control" readonly value="{{$data->user->name??''}}" id="inputFirstName2" required>
							</div>
							@endif

<!-- 							<div class="col-md-2">
								<label for="inputFirstName2" class="form-label">Hajeri Shed</label>
								<input type="text" name="email" class="form-control" readonly value="{{$data->barcode->hajeri->hajeri_shed??''}}" id="inputFirstName2" required>
							</div> -->

							<div class="col-md-2">
								<label for="inputState" class="form-label">Area Name</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->barcode->address??''}}" id="inputState">
							</div>

							<div class="col-md-2">
								<label for="inputState" class="form-label">Ward Name</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->barcode->ward->name??''}}" id="inputState">
							</div>

							<div class="col-md-2">
								<label for="inputState" class="form-label">QR ID</label>
								<input type="text" name="podate" class="form-control" readonly value="{{$data->barcode_id??0}}" id="inputState">
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6" style="margin-top: 30px;">
								<h6>Morning Before Work</h6>
								<div class="row">
									<div class="col-md-6">
										@if($data->before_work!=null)
										<a href="{{config('app.baseURL')}}/storage/app/{{$data->before_work}}" target="_blank"><img src="{{config('app.baseURL')}}/storage/app/{{$data->before_work}}" style="width: 100%;height:200px"></a>
										@endif
									</div>
									<div class="col-md-6">
										<label for="inputCity" class="form-label">Time</label>
										<input type="text" name="ponumber" value="{{$data->before_time}}" class="form-control" readonly value="" id="inputCity">
										<label for="inputCity" class="form-label">Latitude + Longitude</label>
										<input type="text" name="ponumber" class="form-control" readonly value="{{$data->before_latlng}}" id="inputCity">
										
									</div>
								</div>
							</div>
							

							<div class="col-lg-6" style="margin-top: 30px;">
								<h6>Morning After Work</h6>
								<div class="row">
									<div class="col-md-6">
										@if($data->after_work!=null)
										<a href="{{config('app.baseURL')}}/storage/app/{{$data->after_work}}" target="_blank"><img src="{{config('app.baseURL')}}/storage/app/{{$data->after_work}}" style="width: 100%;height:200px"></a>
										@endif
									</div>
									<div class="col-md-6">
										<label for="inputCity" class="form-label">Time</label>
										<input type="text" name="ponumber" value="{{$data->after_time}}" class="form-control" readonly value="" id="inputCity">
										<label for="inputCity" class="form-label">Latitude + Longitude</label>
										<input type="text" name="ponumber" class="form-control" readonly value="{{$data->after_latlng}}" id="inputCity">
										
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<label for="inputCity" class="form-label">Remark</label>
								<input type="text" name="ponumber" class="form-control" readonly value="{{$data->remark}}" id="inputCity">
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6" style="margin-top: 30px;">
								<h6>Afternoon Before Work</h6>
								<div class="row">
									<div class="col-md-6">
										@if($data->section_before_work!=null)
										<a href="{{config('app.baseURL')}}/storage/app/{{$data->section_before_work}}" target="_blank"><img src="{{config('app.baseURL')}}/storage/app/{{$data->section_before_work}}" style="width: 100%;height:200px"></a>
										@endif
									</div>
									<div class="col-md-6">
										<label for="inputCity" class="form-label">Time</label>
										<input type="text" name="ponumber" value="{{$data->section_before_time}}" class="form-control" readonly value="" id="inputCity">
										<label for="inputCity" class="form-label">Latitude + Longitude</label>
										<input type="text" name="ponumber" class="form-control" readonly value="{{$data->section_before_latlng}}" id="inputCity">
										
									</div>
								</div>
							</div>
							

							<div class="col-lg-6" style="margin-top: 30px;">
								<h6>Afternoon After Work</h6>
								<div class="row">
									<div class="col-md-6">
										@if($data->section_after_work!=null)
										<a href="{{config('app.baseURL')}}/storage/app/{{$data->section_after_work}}" target="_blank"><img src="{{config('app.baseURL')}}/storage/app/{{$data->section_after_work}}" style="width: 100%;height:200px"></a>
										@endif
									</div>
									<div class="col-md-6">
										<label for="inputCity" class="form-label">Time</label>
										<input type="text" name="ponumber" value="{{$data->section_after_time}}" class="form-control" readonly value="" id="inputCity">
										<label for="inputCity" class="form-label">Latitude + Longitude</label>
										<input type="text" name="ponumber" class="form-control" readonly value="{{$data->section_after_latlng}}" id="inputCity">
										
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<label for="inputCity" class="form-label">Remark</label>
								<input type="text" name="ponumber" class="form-control" readonly value="{{$data->section_remark}}" id="inputCity">
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6" style="margin-top: 30px;">
								<h6>Evening/Night Before Work</h6>
								<div class="row">
									<div class="col-md-6">
										@if($data->section1_before_work!=null)
										<a href="{{config('app.baseURL')}}/storage/app/{{$data->section1_before_work}}" target="_blank"><img src="{{config('app.baseURL')}}/storage/app/{{$data->section1_before_work}}" style="width: 100%;height:200px"></a>
										@endif
									</div>
									<div class="col-md-6">
										<label for="inputCity" class="form-label">Time</label>
										<input type="text" name="ponumber" value="{{$data->section1_before_time}}" class="form-control" readonly value="" id="inputCity">
										<label for="inputCity" class="form-label">Latitude + Longitude</label>
										<input type="text" name="ponumber" class="form-control" readonly value="{{$data->section1_before_latlng}}" id="inputCity">
										
									</div>
								</div>
							</div>
							

							<div class="col-lg-6" style="margin-top: 30px;">
								<h6>Evening/Night After Work</h6>
								<div class="row">
									<div class="col-md-6">
										@if($data->section1_after_work!=null)
										<a href="{{config('app.baseURL')}}/storage/app/{{$data->section1_after_work}}" target="_blank"><img src="{{config('app.baseURL')}}/storage/app/{{$data->section1_after_work}}" style="width: 100%;height:200px"></a>
										@endif
									</div>
									<div class="col-md-6">
										<label for="inputCity" class="form-label">Time</label>
										<input type="text" name="ponumber" value="{{$data->section1_after_time}}" class="form-control" readonly value="" id="inputCity">
										<label for="inputCity" class="form-label">Latitude + Longitude</label>
										<input type="text" name="ponumber" class="form-control" readonly value="{{$data->section1_after_latlng}}" id="inputCity">
										
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<label for="inputCity" class="form-label">Remark</label>
								<input type="text" name="ponumber" class="form-control" readonly value="{{$data->section1_remark}}" id="inputCity">
							</div>
						</div>





						<div class="row">
							
							<div class="col-md-12" style="margin-top:50px;">
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