@extends('layouts.app')
@section('content')
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<div class="row">
			<div class="col-xl-12">
				<div class="card border-top border-0 border-4 border-primary">
					<div class="card-body p-5">
						<div class="card-title d-flex align-items-center">
							<div><i class="bx bxs-user-plus me-1 font-22 text-primary"></i>
							</div>
							<h5 class="mb-0 text-primary">Add New Booking</h5>
						</div>
						<hr>
						<form method="POST" action="{{config('app.baseURL')}}/booking/add" class="row g-3">
							@csrf

							<div class="col-6">
								<label for="inputPhoneNo" class="form-label">Mobile Number</label>
								<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-microphone' ></i></span>
									<input type="text" class="form-control border-start-0" id="inputPhoneNo" placeholder="Mobile Number" minlength="10" maxlength="10" name="mobile_number" onkeyup="getMobileNumber(this.value)" />
								</div>
							</div>


							<div class="col-6">
								<label for="inputLastName1" class="form-label">Full Name</label>
								<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
									<input type="text" class="form-control border-start-0" id="name" placeholder="Full Name" name="name" required />
								</div>
							</div>


							<div class="col-6 email">
								<label for="inputEmailAddress" class="form-label">Email Address</label>
								<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-message' ></i></span>
									<input type="email" class="form-control border-start-0" id="email" placeholder="Email Address" name="email" required />
								</div>
							</div>
							<div class="col-12 email">
								<label for="inputEmailAddress" class="form-label">Address</label>

								<textarea required placeholder="Address" class="form-control" rows="5" name="address" id="address"></textarea>
							</div>
							<div class="col-6 email">
								<label for="inputEmailAddress" class="form-label">Booking Date</label>
								<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-calendar' ></i></span>
									<input type="date" class="form-control border-start-0" id="inputEmailAddress" placeholder="Date" name="booking_date" required />
								</div>
							</div>
							<div class="col-6 email">
								<label for="inputEmailAddress" class="form-label">Booking Time</label>
								<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-calendar' ></i></span>
									<input type="time" class="form-control border-start-0" id="inputEmailAddress" placeholder="Time" name="booking_time" required />
								</div>
							</div>
							<div class="col-6 email">
								<label for="inputEmailAddress" class="form-label">Leave Date</label>
								<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-calendar' ></i></span>
									<input type="date" class="form-control border-start-0" id="inputEmailAddress" placeholder="Date" name="leave_date" required />
								</div>
							</div>
							<div class="col-6 email">
								<label for="inputEmailAddress" class="form-label">Leave Time</label>
								<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-calendar' ></i></span>
									<input type="time" class="form-control border-start-0" id="inputEmailAddress" placeholder="Time" name="leave_time" required />
								</div>
							</div>
							<div class="col-6 email">
								<label for="inputEmailAddress" class="form-label">Payment Amount</label>
								<div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-card' ></i></span>
									<input type="text" class="form-control border-start-0" id="inputEmailAddress" placeholder="Payment Amount" name="amount" required />
								</div>
							</div>

							<div class="col-12">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="gridCheck2" required>
									<label class="form-check-label" for="gridCheck2">Are you sure want to proceed data</label>
								</div>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Add Booking</button>
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
	function getMobileNumber(number)
	{
		if(number.length==10)
		{
			$.ajax({
				url: "{{config('app.baseURL')}}/booking/get-data",
				type: 'GET',
				data: {mobile_number: number},
				success:function(data)
				{
					$("#name").val(data['name']);
					$("#email").val(data['email']);
					$("#address").val(data['address']);
				}
			});
		}
		else
		{
			$("#name").val('');
			$("#email").val('');
			$("#address").val('');
		}
	}
</script>
@endsection