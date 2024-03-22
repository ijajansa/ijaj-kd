@extends('layouts.app')
@section('content')
<style type="text/css">
	.closeImage{
		    position: absolute;
    right: 0px;
    top: -9px;
    width: 25px;
    height: 25px;
    background: #eee;
    border-radius: 50%;
    font-size: 22px;
    line-height: 24px;
    padding-left: 7px;
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
							<div><i class="bx bx-plus me-1 font-22 text-primary"></i>
							</div>
							<h5 class="mb-0 text-primary" style="font-weight: bold;">Add Employee</h5>
						</div>
						<hr>
						<form class="row g-3" method="POST" action="{{config('app.baseURL')}}/employee/add">
							@csrf
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Name</label>
								<input type="text" name="name" required class="form-control" placeholder="Name">
							</div>

							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Email Address</label>
								<input type="email" name="email" class="form-control" placeholder="Email Address">
							</div>
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Contact Number</label>
								<input type="text" name="mobile_number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" minlength="10" required class="form-control" placeholder="Contact Number">
							</div>

							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Select Inspector</label>
								<select class="form-control form-select" required name="inspector_id">
									<option value="">Select Inspector</option>
									@foreach($inspectors as $inspector)
									<option value="{{$inspector->id}}">{{$inspector->name}}</option>
									@endforeach
								</select>
							</div>
							
							<div class="col-md-12">
								<label for="inputFirstName2" class="form-label">Address</label>
								<textarea rows="4" name="address" class="form-control" placeholder="Address"></textarea>
							</div>


							
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Password</label>
								<input type="password" name="password" minlength="8" required class="form-control" placeholder="Password">
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Register</button>
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