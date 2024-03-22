@extends('layouts.app')
@section('content')
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<div class="row">
			<div class="col-xl-6">
				<div class="card border-top border-0 border-4 border-primary">
					<div class="card-body p-5">
						<div class="card-title d-flex align-items-center">
							<div><i class="bx bxs-user-plus me-1 font-22 text-primary"></i>
							</div>
							<h5 class="mb-0 text-primary">Update Hajeri Shed Details</h5>
						</div>
						<hr>
						<form method="POST" action="{{config('app.baseURL')}}/hajeri-shed/edit/{{$data->id}}" class="row g-3">
							@csrf

							<div class="col-12">
								<label for="inputLastName1" class="form-label">Hajeri Shed</label>
								<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-edit'></i></span>
									<input type="text" value="{{$data->hajeri_shed}}" class="form-control border-start-0" id="name" placeholder="Hajeri Shed" name="hajeri_shed" required />
								</div>
							</div>

							<div class="col-12">
								<label for="inputLastName1" class="form-label">Select Ward</label>
								<select class="form-control form-select" name="ward_id" required>
								<option value="">Select</option>
								@foreach($wards as $ward)
								<option value="{{$ward->id}}" @if($ward->id==$data->ward_id) selected @endif>{{$ward->name}}</option>
								@endforeach
						</select>
							</div>

							<div class="col-12">
								<label for="inputLastName1" class="form-label">Status</label>
								<select name="status" class="form-control form-select">
									<option value="1" @if($data->is_active==1) selected @endif>Active</option>
									<option value="0" @if($data->is_active==0) selected @endif>Inactive</option>
								</select>
							</div>

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