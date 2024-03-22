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
							<div><i class="bx bx-plus me-1 font-22 text-primary"></i>
							</div>
							<h5 class="mb-0 text-primary" style="font-weight: bold;">Add Inspector</h5>
						</div>
						<hr>
						<form class="row g-3" method="POST" action="{{config('app.baseURL')}}/user/add">
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
								<label for="inputFirstName2" class="form-label">Select Ward</label>
								<select class="form-control form-select" required onchange="getArea1(this.value)" name="ward_id">
									<option value="">Select Ward</option>
									@foreach($wards as $ward)
									<option value="{{$ward->id}}">{{$ward->name}}</option>
									@endforeach
								</select>
							</div>
<!-- 							<div class="col-md-6">
								<label class="form-label">Select Hajeri Shed</label>
								<select class="multiple-select" class="form-control" id="shed_id" name="shed_id[]" data-placeholder="Choose anything" multiple="multiple" onchange="getArea1()" required>			
								</select>
							</div> -->
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Select Area</label>
								<select class="multiple-select" required name="area_id[]" id="area_id" data-placeholder="Choose anything" multiple="multiple">
									<option value="">Select Area</option>
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

<script type="text/javascript">
	function getArea1(ward_id)
	{
		// ward_id=$("#shed_id").val();
		data=[];
		data.push(ward_id);
		if(data.length!=0)
		{
			$.ajax({
				url: "{{config('app.baseURL')}}/user/get-area",
				type:"GET",
				data:{ward_id:data[0]},
				success:function(data)
				{
					$("#area_id").html(data);
				}
			});
		}
	}

	function getArea(ward_id)
	{
		if(ward_id.length!=0)
		{
			$.ajax({
				url: "{{config('app.baseURL')}}/user/get-area",
				type:"GET",
				data:{ward_id:ward_id},
				success:function(data)
				{
					$("#area_id").html(data);
				}
			});
		}
	}
</script>
<script src="{{config('app.baseURL')}}/assets/plugins/select2/js/select2.min.js"></script>

	<script>
	
		$('.multiple-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
	</script>
<script type="text/javascript">
	function getHajeriShed(id)
	{
		if(id.length!=0)
		{
			$.ajax({
				url:"{{config('app.baseURL')}}/barcode/getHajeriShed",
				type:'GET',
				data:{id:id},
				success:function(data)
				{
					$("#shed_id").html(data);
				}
			});
		}
	}
</script>
@endsection