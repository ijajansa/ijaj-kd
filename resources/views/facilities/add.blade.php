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
									<h5 class="mb-0 text-primary">Add Employee</h5>
								</div>
								<hr>
								<form method="POST" action="{{config('app.baseURL')}}/employee/add" class="row g-3">
									@csrf
									<div class="col-12">
										<label for="inputLastName1" class="form-label">Full Name</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
											<input type="text" class="form-control border-start-0" id="inputLastName1" placeholder="Full Name" name="name" required />
										</div>
									</div>
									<div class="col-12">
										<label for="inputAddress3" class="form-label">Select Designation</label>
										<select class="form-select" name="role_id" required>
											<option value="">Designation</option>
											@foreach($role as $role)
											<option value="{{$role->role_id}}">{{$role->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-12">
										<label for="inputLastName2" class="form-label">Select Type</label>
										<div class="input-group">
											
											<input type="radio" checked required onchange="sameRadio(this.value)" name="select_type" style="margin-top: 4px;" value="1" id="val1">&nbsp;<label class="form-check-label" for="val1">Worker With Panel</label>&nbsp;&nbsp;&nbsp;&nbsp;
											<input type="radio" required onchange="sameRadio(this.value)" name="select_type" style="margin-top: 4px;" value="0" id="val0">&nbsp;<label class="form-check-label" for="val0">Worker</label>
										</div>
									</div>
									
									
									<div class="col-12 email">
										<label for="inputEmailAddress" class="form-label">Email Address</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
											<input type="email" class="form-control border-start-0" id="inputEmailAddress" placeholder="Email Address" name="email" required />
										</div>
									</div>
									<div class="col-12">
										<label for="inputPhoneNo" class="form-label">Mobile Number</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-microphone' ></i></span>
											<input type="text" class="form-control border-start-0" id="inputPhoneNo" placeholder="Mobile Number" minlength="10" maxlength="10" name="mobile" />
										</div>
									</div>
									<div class="col-12 pass">
										<label for="inputChoosePassword" class="form-label">Choose Password</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock-open' ></i></span>
											<input type="text" class="form-control border-start-0 inputChoosePassword" id="inputChoosePassword" placeholder="Choose Password" required name="password" />
										</div>
									</div>
									<div class="col-12 pass">
										<label for="inputConfirmPassword" class="form-label">Confirm Password</label>
										<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-lock' ></i></span>
											<input type="text" class="form-control border-start-0 inputChoosePassword" id="inputConfirmPassword" placeholder="Confirm Password" required name="password1" />
										</div>
									</div>
									
									<div class="col-12">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="gridCheck2" required>
											<label class="form-check-label" for="gridCheck2">Are you sure want to proceed data</label>
										</div>
									</div>
									<div class="col-12">
										<button type="submit" class="btn btn-primary px-5">Upload</button>
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
		<script type="text/javascript">	
			function sameRadio(val)
			{
				if(val==0)
				{
					$(".email").hide();
					$(".pass").hide();
					$("#inputEmailAddress").removeAttr('required','required');
					$(".inputChoosePassword").removeAttr('required','required');
				}
				else
				{
					$(".email").show();	
					$(".pass").show();
					$("#inputEmailAddress").attr('required','required');
					$(".inputChoosePassword").attr('required','required');
				}
			}
			
		</script>
@endsection